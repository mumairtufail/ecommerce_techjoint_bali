<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class IndexController extends BaseController
{

    
    public function index()
    {
        $categories = Category::all();
        
        // Get products with category relationships and filter by status
        $products = Product::with('category')->where('status', 1)->get();
        
        // Separate products by flags for better performance (matching the create form values)
        $featuredProducts = $products->where('flag', 'Featured')->take(8);
        $newProducts = $products->where('flag', 'new')->take(8);
        
        return view('web.index', $this->withBanners([
            'products' => $products,
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
            'newProducts' => $newProducts
        ]));
    }
}
