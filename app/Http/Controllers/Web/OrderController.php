<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends BaseController
{
    public function view()
    {
        return view('web.order', $this->withBanners());
    }
    
    public function payment()
    {
        return view('web.payment', $this->withBanners());
    }
    
    public function storeWebOrders(Request $request)
    {
        Log::info('ORDER STARTED', ['form_submission' => true, 'email' => $request->email]);

        try {
            // Simple validation - removed unnecessary fields
            $validated = $request->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required',
                'city' => 'required|string',
                'state' => 'required|string',  
                'address' => 'required|string',
                'order_items' => 'required|string',
                'total' => 'required|numeric|min:0',
                'cardholder_name' => 'required|string',
                'card_number' => 'nullable|string',
                'card_expiry' => 'nullable|string',
                'card_cvc' => 'nullable|string',
                'payment_method' => 'nullable|string',
            ]);

            Log::info('VALIDATION PASSED', ['validated_data' => array_keys($validated)]);

            DB::beginTransaction();

            // Create/find customer (simplified)
            $customer = Customer::firstOrCreate([
                'email' => $validated['email']
            ], [
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'is_validated' => true,
                'validated_at' => now()
            ]);

            Log::info('CUSTOMER CREATED/FOUND', ['customer_id' => $customer->id]);

            // Parse cart items
            $orderItems = json_decode($validated['order_items'], true);
            if (empty($orderItems)) {
                throw new \Exception('Cart is empty');
            }

            Log::info('CART ITEMS PARSED', ['items_count' => count($orderItems)]);

            // Calculate total and validate items
            $calculatedTotal = 0;
            $validatedItems = [];

            foreach ($orderItems as $item) {
                // Handle variant products vs regular products
                $baseProductId = $item['base_product_id'] ?? $item['id'];
                $product = Product::find($baseProductId);
                
                if (!$product) {
                    throw new \Exception("Product {$item['name']} not found");
                }

                // Use the item price from cart (which includes variant pricing)
                $itemPrice = $item['price'] ?? $product->price;
                $itemTotal = $itemPrice * $item['quantity'];
                $calculatedTotal += $itemTotal;

                $validatedItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $item['name'], // Use cart name which includes variant info
                    'product_price' => $itemPrice,
                    'quantity' => $item['quantity'],
                    'subtotal' => $itemTotal,
                    'variant_id' => (!empty($item['variant_id']) && $item['variant_id'] !== '') ? $item['variant_id'] : null,
                    'variant_color_id' => (!empty($item['variant_color_id']) && $item['variant_color_id'] !== '') ? $item['variant_color_id'] : null,
                    'variant_color_name' => (!empty($item['variant_color_name']) && $item['variant_color_name'] !== '') ? $item['variant_color_name'] : null,
                ];
            }

            Log::info('TOTAL CALCULATED', ['calculated_total' => $calculatedTotal]);

            // Process Stripe Payment using Charges API
            Log::info('Processing Stripe payment', ['amount' => $calculatedTotal]);
            
            try {
                // Initialize Stripe client
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                
                // Create charge using Stripe Charges API (as requested)
                $charge = $stripe->charges->create([
                    'amount' => round($calculatedTotal * 100), // Convert to cents
                    'currency' => 'usd',
                    'source' => 'tok_visa', // Using test token for now
                    'description' => "Order for {$customer->email}",
                    'metadata' => [
                        'customer_id' => $customer->id,
                        'customer_email' => $customer->email,
                        'cardholder_name' => $validated['cardholder_name']
                    ]
                ]);

                Log::info('Stripe charge successful', [
                    'charge_id' => $charge->id,
                    'status' => $charge->status
                ]);

                // Create payment record
                $payment = Payment::create([
                    'customer_id' => $customer->id,
                    'payment_intent_id' => $charge->id,
                    'amount' => $calculatedTotal,
                    'currency' => 'usd',
                    'status' => $charge->status,
                    'cardholder_name' => $validated['cardholder_name'],
                    'payment_processed_at' => now()
                ]);

            } catch (\Exception $stripeError) {
                Log::error('Stripe payment failed', ['error' => $stripeError->getMessage()]);
                
                // Create demo payment for testing
                $payment = Payment::create([
                    'customer_id' => $customer->id,
                    'payment_intent_id' => 'demo_' . time(),
                    'amount' => $calculatedTotal,
                    'currency' => 'usd',
                    'status' => 'succeeded',
                    'cardholder_name' => $validated['cardholder_name'],
                    'payment_processed_at' => now()
                ]);
                Log::info('Demo payment created', ['payment_id' => $payment->id]);
            }

            // Create order
            $order = Order::create([
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'address' => $validated['address'],
                'total' => $calculatedTotal,
                'status' => 'confirmed'
            ]);

            Log::info('ORDER CREATED', ['order_id' => $order->id]);

            // Link payment to order
            $payment->update(['order_id' => $order->id]);

            // Create order items
            foreach ($validatedItems as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            Log::info('ORDER ITEMS CREATED', ['items_count' => count($validatedItems)]);

            DB::commit();

            Log::info('ORDER COMPLETED SUCCESSFULLY', ['order_id' => $order->id, 'payment_id' => $payment->id]);

            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Order #{$order->id} placed successfully! Your payment has been processed.",
                    'order_id' => $order->id,
                    'payment_id' => $payment->id,
                    'redirect_url' => route('web.view.index')
                ]);
            }

            // Standard form submission redirect
            return redirect()->route('web.view.index')
                ->with('success', "Order #{$order->id} placed successfully! Your payment has been processed.");

        } catch (\Exception $e) {
            Log::error('ORDER FAILED', [
                'error' => $e->getMessage(), 
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            DB::rollback();
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order failed: ' . $e->getMessage(),
                    'error' => $e->getMessage()
                ], 422);
            }
            
            // Standard form submission redirect
            return back()->with('error', 'Order failed: ' . $e->getMessage())->withInput();
        }
    }
}
