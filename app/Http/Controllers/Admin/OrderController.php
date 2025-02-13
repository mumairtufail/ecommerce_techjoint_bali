<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function show($id) {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }
}
