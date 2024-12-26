<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    
    public function View()
    {
        $products = Product::all();
        return view('web.shop', compact('products'));
    }

}
