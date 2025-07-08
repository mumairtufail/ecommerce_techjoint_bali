<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Controllers\Web\BaseController;
use App\Models\Category;

class ShopController extends BaseController
{
    
    public function View(Request $request)
    {
        $categories = Category::where('status', 1)->get();
        
        // Start with all active products
        $query = Product::with('category')->where('status', 1);
        
        // Apply category filter if provided
        $selectedCategoryId = $request->get('category');
        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }
        
        // Get filtered products
        $products = $query->get();
        
        // Get the selected category for display
        $selectedCategory = null;
        if ($selectedCategoryId) {
            $selectedCategory = Category::find($selectedCategoryId);
        }
        
        return view('web.shop.shop', $this->withBanners([
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'selectedCategoryId' => $selectedCategoryId
        ]));
    }

    // public function productDetails($id)
    // {
    //     $product = Product::with('category')->findOrFail($id);
        
    //     // Get related products from the same category (excluding current product)
    //     $relatedProducts = Product::with('category')
    //         ->where('category_id', $product->category_id)
    //         ->where('id', '!=', $product->id)
    //         ->where('status', 1)
    //         ->limit(5)
    //         ->get();
        
    //     return view('web.product-details', $this->withBanners([
    //         'product' => $product,
    //         'relatedProducts' => $relatedProducts
    //     ]));
    // }

    public function productDetails($id)
    {
        $product = Product::with(['category', 'sizes', 'colors', 'variants.size', 'variants.color', 'images'])
            ->findOrFail($id);
        
        // Get related products from the same category (excluding current product)
        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 1)
            ->limit(5)
            ->get();
        
        return view('web.product-details', $this->withBanners([
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ]));
    }
}
