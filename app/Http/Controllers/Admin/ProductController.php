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
        $products = Product::with(['category', 'variants', 'images'])->latest()->get();
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
        'images' => 'required|array|min:1|max:4', // Maximum 4 images, at least 1 required
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'thumbnail_image_index' => 'nullable|integer|min:0', // Index of the thumbnail image
        'flag' => 'nullable|string|in:All Items,New Arrivals,Featured,On Sale',
        'variants' => 'nullable|array',
        'variants.*.color_id' => 'required|exists:product_colors,id',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.price_adjustment' => 'nullable|numeric',
    ]);
    
    try {
        DB::beginTransaction();
        
        // Create product without image field initially
        $productData = $validated;
        unset($productData['images'], $productData['thumbnail_image_index']);
        $product = Product::create($productData);

        // Handle multiple images with thumbnail selection
        if ($request->hasFile('images')) {
            $thumbnailIndex = $request->input('thumbnail_image_index', 0); // Default to first image
            
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
                    'is_primary' => $index == $thumbnailIndex, // Selected thumbnail is primary
                ]);
            }
            
            // Set the legacy image field to the primary image for backward compatibility
            $primaryImage = $product->images()->where('is_primary', true)->first();
            if ($primaryImage) {
                $product->update(['image' => $primaryImage->image_path]);
            }
        }

        // Create variants if provided
        if (!empty($validated['variants'])) {
            $colorIds = [];
            $sizeIds = [];
            
            foreach ($validated['variants'] as $variantData) {
                $variantData['product_id'] = $product->id;
                $variantData['size_id'] = null; // No sizes for now, only colors
                $variantData['price_adjustment'] = $variantData['price_adjustment'] ?? 0;
                $variant = ProductVariant::create($variantData);
                
                // Collect color and size IDs for syncing
                if (!empty($variantData['color_id'])) {
                    $colorIds[] = $variantData['color_id'];
                }
                if (!empty($variantData['size_id'])) {
                    $sizeIds[] = $variantData['size_id'];
                }
            }
            
            // Sync colors and sizes to the product's many-to-many relationships
            if (!empty($colorIds)) {
                $product->colors()->sync(array_unique($colorIds));
            }
            if (!empty($sizeIds)) {
                $product->sizes()->sync(array_unique($sizeIds));
            }
        }
        
        DB::commit();

        Log::info('Product created successfully', [
            'product_id' => $product->id,
            'name' => $product->name,
            'user_id' => auth()->id(),
            'primary_image_path' => $product->image ?? null,
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
        'images' => 'nullable|array|max:4',
        'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        'thumbnail_image_index' => 'nullable|integer|min:0', // Index of the thumbnail image
        'flag' => 'nullable|string|in:All Items,New Arrivals,Featured,On Sale',
        'variants' => 'nullable|array',
        'variants.*.color_id' => 'required|exists:product_colors,id',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.price_adjustment' => 'nullable|numeric',
        'existing_variants' => 'nullable|array',
        'existing_variants.*.color_id' => 'required|exists:product_colors,id',
        'existing_variants.*.stock' => 'required|integer|min:0',
        'existing_variants.*.price_adjustment' => 'nullable|numeric',
        'remove_variants' => 'nullable|array',
        'remove_variants.*' => 'integer|exists:product_variants,id',
        'remove_images' => 'nullable|array',
        'remove_images.*' => 'integer|exists:product_images,id',
        'existing_thumbnail_index' => 'nullable|integer|min:0', // For selecting thumbnail from existing images
    ]);

    try {
        DB::beginTransaction();

        // Update basic product information
        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'flag' => $validated['flag'] ?? 'All Items',
        ]);

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
            $thumbnailIndex = $request->input('thumbnail_image_index', 0); // For new images
            
            foreach ($request->file('images') as $index => $image) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $image->getClientOriginalExtension();
                $timestamp = now()->format('Ymd_His');
                $cleanName = preg_replace('/[^A-Za-z0-9\-_]/', '', $originalName);
                $cleanName = substr($cleanName, 0, 50);
                
                $newFileName = $timestamp . '_' . ($index + 1) . '_' . $cleanName . '.' . $extension;
                $imagePath = $image->storeAs('products', $newFileName, 'public');
                
                // If this is the first image and no existing images, make it primary
                $isPrimary = ($product->images()->count() === 0 && $index === 0) || 
                           ($index == $thumbnailIndex);
                
                $product->images()->create([
                    'image_path' => $imagePath,
                    'alt_text' => $product->name . ' - Image ' . ($currentMaxSortOrder + $index + 2),
                    'sort_order' => $currentMaxSortOrder + $index + 1,
                    'is_primary' => $isPrimary,
                ]);
            }
        }

        // Handle thumbnail selection from existing images
        if ($request->has('existing_thumbnail_index') && $request->input('existing_thumbnail_index') !== null) {
            // Reset all existing images to not primary
            $product->images()->update(['is_primary' => false]);
            
            // Set the selected existing image as primary
            $existingImages = $product->images()->orderBy('sort_order')->get();
            $thumbnailIndex = $request->input('existing_thumbnail_index');
            
            if (isset($existingImages[$thumbnailIndex])) {
                $existingImages[$thumbnailIndex]->update(['is_primary' => true]);
            }
        }

        // Ensure we have a primary image and update the legacy image field
        $primaryImage = $product->images()->where('is_primary', true)->first();
        if (!$primaryImage && $product->images()->count() > 0) {
            // If no primary image is set, make the first one primary
            $firstImage = $product->images()->orderBy('sort_order')->first();
            $firstImage->update(['is_primary' => true]);
            $primaryImage = $firstImage;
        }

        // Update the legacy image field for backward compatibility
        if ($primaryImage) {
            $product->update(['image' => $primaryImage->image_path]);
        } else {
            $product->update(['image' => null]);
        }

        // Update variants
        // Handle removal of existing variants
        if (!empty($validated['remove_variants'])) {
            $product->variants()->whereIn('id', $validated['remove_variants'])->delete();
        }

        $colorIds = [];
        $sizeIds = [];

        // Update existing variants
        if (!empty($validated['existing_variants'])) {
            foreach ($validated['existing_variants'] as $variantId => $variantData) {
                $variant = $product->variants()->find($variantId);
                if ($variant) {
                    $variant->update([
                        'color_id' => $variantData['color_id'],
                        'size_id' => null, // No sizes for now, only colors
                        'stock' => $variantData['stock'],
                        'price_adjustment' => $variantData['price_adjustment'] ?? 0,
                    ]);
                    
                    // Collect color and size IDs
                    if (!empty($variantData['color_id'])) {
                        $colorIds[] = $variantData['color_id'];
                    }
                    if (!empty($variantData['size_id'])) {
                        $sizeIds[] = $variantData['size_id'];
                    }
                }
            }
        }

        // Create new variants
        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $variantData) {
                $variantData['product_id'] = $product->id;
                $variantData['size_id'] = null; // No sizes for now, only colors
                $variantData['price_adjustment'] = $variantData['price_adjustment'] ?? 0;
                $variant = ProductVariant::create($variantData);
                
                // Collect color and size IDs
                if (!empty($variantData['color_id'])) {
                    $colorIds[] = $variantData['color_id'];
                }
                if (!empty($variantData['size_id'])) {
                    $sizeIds[] = $variantData['size_id'];
                }
            }
        }
        
        // Get all current variant colors and sizes and sync them
        $allVariants = $product->variants()->get();
        foreach ($allVariants as $variant) {
            if ($variant->color_id) {
                $colorIds[] = $variant->color_id;
            }
            if ($variant->size_id) {
                $sizeIds[] = $variant->size_id;
            }
        }
        
        // Sync colors and sizes to the product's many-to-many relationships
        if (!empty($colorIds)) {
            $product->colors()->sync(array_unique($colorIds));
        } else {
            $product->colors()->sync([]);
        }
        
        if (!empty($sizeIds)) {
            $product->sizes()->sync(array_unique($sizeIds));
        } else {
            $product->sizes()->sync([]);
        }

        DB::commit();

        Log::info('Product updated successfully', [
            'product_id' => $product->id,
            'name' => $product->name,
            'user_id' => auth()->id(),
            'primary_image_path' => $product->image ?? null,
            'total_images' => $product->images()->count()
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$product->name}' updated successfully!");
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        Log::error('Failed to update product', [
            'product_id' => $product->id,
            'error' => $e->getMessage(),
            'user_id' => auth()->id()
        ]);
        
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

            // Delete legacy single image if exists
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            // Delete all multiple images
            $productImages = $product->images;
            foreach ($productImages as $productImage) {
                Storage::disk('public')->delete($productImage->image_path);
                $productImage->delete();
            }

            // Delete the product (this will also cascade delete related records)
            $product->delete();

            DB::commit();

            Log::info('Product deleted successfully', [
                'product_id' => $product->id,
                'name' => $productName,
                'user_id' => auth()->id(),
                'images_deleted' => $productImages->count()
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
        $product->load(['category',  'variants.size', 'variants.color', 'images']);
        
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