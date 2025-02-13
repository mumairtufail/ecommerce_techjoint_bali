<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends BaseController
{
    public function view()
    {
        return view('web.order', $this->withBanners());
    }
    
    // New method to store an order from the cart & form details
    public function store(Request $request)
    {
        // Extract form fields, rename keys to match database columns
        $data = $request->only(['firstName', 'lastName', 'email', 'phone', 'postalCode', 'city', 'country']);
        $data['first_name']   = $data['firstName'] ?? null;
        $data['last_name']    = $data['lastName'] ?? null;
        $data['postal_code']  = $data['postalCode'] ?? null;
        unset($data['firstName'], $data['lastName'], $data['postalCode']);
        
        // Get order summary details from request (assumed sent as hidden fields or JSON post)
        $data['order_items'] = $request->input('order_items'); // expects JSON data
        $data['total']       = $request->input('total');

        Order::create($data);

        return redirect('/')->with('success', 'Order placed successfully!');
    }
}
