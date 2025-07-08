<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'sizes', 'colors', 'variants', 'images'])->latest()->get();
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'flag' => 'nullable|string|in:All Items,New Arrivals,Featured,On Sale',
        'variants' => 'nullable|array',
        'variants.*.size_id' => 'nullable|exists:product_sizes,id',
        'variants.*.color_id' => 'nullable|exists:product_colors,id',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.price_adjustment' => 'nullable|numeric',
    ]);
    
    try {
        DB::beginTransaction();
        
        if ($request->hasFile('image')) {
            $originalName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');
            
            // Clean the original name (remove special characters)
            $cleanName = preg_replace('/[^A-Za-z0-9\-_]/', '', $originalName);
            $cleanName = substr($cleanName, 0, 50); // Limit length
            
            // Create custom filename: timestamp_cleanname.extension
            $newFileName = $timestamp . '_' . $cleanName . '.' . $extension;
            
            // Store with custom filename
            $imagePath = $request->file('image')->storeAs('products', $newFileName, 'public');
            $validated['image'] = $imagePath;
        }
        
        $product = Product::create($validated);

        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $cleanName = preg_replace('/[^A-Za-z0-9\-_]/', '', $originalName);
                $cleanName = substr($cleanName, 0, 50);
                
                $newFileName = $timestamp . '_' . ($index + 1) . '_' . $cleanName . '.' . $extension;
                $imagePath = $image->storeAs('products', $newFileName, 'public');
                
                $product->images()->create([
                    'image_path' => $imagePath,
                    'alt_text' => $product->name . ' - Image ' . ($index + 1),
                    'sort_order' => $index,
                    'is_primary' => $index === 0, // First image is primary
                ]);
            }
        }

        // Create variants if provided
        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantData) {
                $variantData['product_id'] = $product->id;
                $variantData['price_adjustment'] = $variantData['price_adjustment'] ?? 0;
                ProductVariant::create($variantData);
            }
        }
        
        DB::commit();

        Log::info('Product created successfully', [
            'product_id' => $product->id,
            'name' => $product->name,
            'user_id' => auth()->id(),
            'image_path' => $validated['image'] ?? null,
            'images_count' => $request->hasFile('images') ? count($request->file('images')) : 0
        ]);
        
        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$product->name}' created successfully!");
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('Failed to create product', [
            'error' => $e->getMessage(),
            'user_id' => auth()->id(),
            'request_data' => $request->except(['image', 'images'])
        ]);
        
        return redirect()->route('admin.products.index')
            ->with('error', 'Failed to create product. Please try again.');
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
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'images' => 'nullable|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'flag' => 'nullable|string|in:All Items,New Arrivals,Featured,On Sale',
        'variants' => 'nullable|array',
        'variants.*.size_id' => 'nullable|exists:product_sizes,id',
        'variants.*.color_id' => 'nullable|exists:product_colors,id',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.price_adjustment' => 'nullable|numeric',
        'remove_images' => 'nullable|array',
        'remove_images.*' => 'integer|exists:product_images,id',
    ]);

    try {
        DB::beginTransaction();

        $oldImagePath = $product->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }
            
            // Create new custom filename
            $originalName = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $timestamp = now()->format('Ymd_His');
            $cleanName = preg_replace('/[^A-Za-z0-9\-_]/', '', $originalName);
            $cleanName = substr($cleanName, 0, 50);
            
            $newFileName = $timestamp . '_' . $cleanName . '.' . $extension;
            $imagePath = $request->file('image')->storeAs('products', $newFileName, 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        // Handle removing existing images
        if (!empty($validated['remove_images'])) {
            $imagesToRemove = $product->images()->whereIn('id', $validated['remove_images'])->get();
            foreach ($imagesToRemove as $imageToRemove) {
                Storage::disk('public')->delete($imageToRemove->image_path);
                $imageToRemove->delete();
            }
        }

        // Handle new multiple images
        if ($request->hasFile('images')) {
            $currentMaxSortOrder = $product->images()->max('sort_order') ?? -1;
            
            foreach ($request->file('images') as $index => $image) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $cleanName = preg_replace('/[^A-Za-z0-9\-_]/', '', $originalName);
                $cleanName = substr($cleanName, 0, 50);
                
                $newFileName = $timestamp . '_' . ($index + 1) . '_' . $cleanName . '.' . $extension;
                $imagePath = $image->storeAs('products', $newFileName, 'public');
                
                $product->images()->create([
                    'image_path' => $imagePath,
                    'alt_text' => $product->name . ' - Image ' . ($currentMaxSortOrder + $index + 2),
                    'sort_order' => $currentMaxSortOrder + $index + 1,
                    'is_primary' => $product->images()->count() === 0 && $index === 0, // First image is primary if no images exist
                ]);
            }
        }

        // Update variants
        $product->variants()->delete(); // Remove existing variants
        
        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantData) {
                $variantData['product_id'] = $product->id;
                $variantData['price_adjustment'] = $variantData['price_adjustment'] ?? 0;
                ProductVariant::create($variantData);
            }
        }

        DB::commit();

        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$product->name}' updated successfully!");
            
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('admin.products.index')
            ->with('error', 'Failed to update product. Please try again.');
    }
}

    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $productName = $product->name;
            $imagePath = $product->image;

            // Delete associated image
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            // Delete the product
            $product->delete();

            DB::commit();

            Log::info('Product deleted successfully', [
                'product_id' => $product->id,
                'name' => $productName,
                'user_id' => auth()->id()
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', "Product '{$productName}' deleted successfully!");
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Failed to delete product', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);
            
            return redirect()->route('admin.products.index')
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }

    public function edit(Product $product)
    {
        $product->load(['category', 'sizes', 'colors', 'variants.size', 'variants.color', 'images']);
        
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'allSizes' => ProductSize::active()->ordered()->get(),
            'allColors' => ProductColor::active()->ordered()->get(),
        ]);
    }

    /**
     * Toggle product status (active/inactive)
     */
    public function toggleStatus(Product $product)
    {
        try {
            $product->update(['status' => !$product->status]);
            
            $status = $product->status ? 'activated' : 'deactivated';
            
            Log::info("Product status changed", [
                'product_id' => $product->id,
                'new_status' => $product->status,
                'user_id' => auth()->id()
            ]);
            
            return response()->json([
                'success' => true,
                'message' => "Product {$status} successfully!",
                'new_status' => $product->status
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to toggle product status', [
                'product_id' => $product->id,
                'error' => $e->getMessage(),
                'user_id' => auth()->id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update product status'
            ], 500);
        }
    }

    /**
     * Get product details for viewing
     */
    public function show(Product $product)
    {
        $product->load('category');
        
        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'status' => $product->status,
                'category' => $product->category->name,
                'image' => $product->image ? asset('storage/' . $product->image) : null,
                'created_at' => $product->created_at->format('M d, Y h:i A'),
                'updated_at' => $product->updated_at->format('M d, Y h:i A')
            ]
        ]);
    }
    public function create()
    {
        $categories = Category::all();
        $sizes = ProductSize::active()->ordered()->get();
        $colors = ProductColor::active()->ordered()->get();
        
        return view('admin.products.create', compact('categories', 'sizes', 'colors'));
    }
}