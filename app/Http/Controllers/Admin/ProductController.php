<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log; // Add this import

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();
        
        return view('admin.products.view', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        try {
            DB::beginTransaction();
            
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }
            
            $product = Product::create($validated);
            DB::commit();

            Log::info('Product created successfully', ['product_id' => $product->id]); // Add logging
            
            return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product', ['error' => $e->getMessage()]); // Add logging
            return redirect()->route('admin.products.index')->with('error', 'Failed to create product.');
        }
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }

            $product->update($validated);

            DB::commit();

            Log::info('Product updated successfully', ['product_id' => $product->id]); // Add logging

            return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update product', ['product_id' => $product->id, 'error' => $e->getMessage()]); // Add logging
            return redirect()->route('admin.products.index')->with('error', 'Failed to update product.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            DB::commit();

            Log::info('Product deleted successfully', ['product_id' => $product->id]); // Add logging

            return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete product', ['product_id' => $product->id, 'error' => $e->getMessage()]); // Add logging
            return redirect()->route('admin.products.index')->with('error', 'Failed to delete product.');
        }
    }

    public function edit(Product $product)
    {
        $product->load('category');
        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }
}