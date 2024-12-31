<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Web\BaseController;
class ShopController extends BaseController
{
    
    public function View()
    {
        $products = Product::all();
        return view('web.shop', $this->withBanners([
            'products' => $products
        ]));
    }

}
