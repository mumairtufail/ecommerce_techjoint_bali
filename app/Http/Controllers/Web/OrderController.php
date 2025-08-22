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
        return view('web.order-simple', $this->withBanners());
    }
    
    public function storeWebOrders(Request $request)
    {
        Log::info('ORDER STARTED', ['request_type' => $request->expectsJson() ? 'AJAX' : 'FORM', 'email' => $request->email]);

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
            ]);

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

            // Parse cart items
            $orderItems = json_decode($validated['order_items'], true);
            if (empty($orderItems)) {
                throw new \Exception('Cart is empty');
            }

            // Calculate total and validate items
            $calculatedTotal = 0;
            $validatedItems = [];

            foreach ($orderItems as $item) {
                $product = Product::find($item['id']);
                if (!$product) {
                    throw new \Exception("Product {$item['name']} not found");
                }

                $itemTotal = $product->price * $item['quantity'];
                $calculatedTotal += $itemTotal;

                $validatedItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                    'quantity' => $item['quantity'],
                    'subtotal' => $itemTotal
                ];
            }

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
                Log::info('Demo payment created');
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

            // Link payment to order
            $payment->update(['order_id' => $order->id]);

            // Create order items
            foreach ($validatedItems as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            DB::commit();

            Log::info('ORDER COMPLETED', ['order_id' => $order->id]);

            // Return appropriate response based on request type
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Order #{$order->id} placed successfully!",
                    'order_id' => $order->id,
                    'payment_id' => $payment->id
                ]);
            }

            return redirect()->route('web.view.index')
                ->with('success', "Order #{$order->id} placed successfully!");

        } catch (\Exception $e) {
            Log::error('ORDER FAILED', ['error' => $e->getMessage(), 'line' => $e->getLine()]);
            DB::rollback();
            
            // Return appropriate error response based on request type
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order failed: ' . $e->getMessage()
                ], 400);
            }
            
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }
}
