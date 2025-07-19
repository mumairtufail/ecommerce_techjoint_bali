<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        try {
            $categories = Category::withCount('products')->orderBy('name', 'asc')->get();
            
            return view('admin.categories', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Error loading categories: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load categories.');
        }
    }

    /**
     * Store a newly created category in storage.
     */
  public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
                'description' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'boolean',
            ], [
                'name.required' => 'Category name is required.',
                'name.max' => 'Category name cannot exceed 255 characters.',
                'name.unique' => 'This category name already exists.',
                'description.max' => 'Description cannot exceed 1000 characters.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'image.max' => 'The image must not be greater than 2MB.',
            ]);

            // Handle checkbox field (status)
            $validated['status'] = $request->has('status') ? 1 : 0;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('categories', $imageName, 'public');
                $validated['image'] = $imagePath;
            }

            $category = Category::create($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category created successfully!',
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                        'description' => $category->description,
                        'image' => $category->image,
                        'status' => $category->status,
                        'products_count' => 0,
                        'created_at' => $category->created_at->format('M d, Y'),
                    ]
                ]);
            }

            return redirect()->route('admin.categories.index')
                           ->with('success', 'Category created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->back()
                           ->withErrors($e->errors())
                           ->withInput();
        } catch (\Exception $e) {
            Log::error('Error creating category: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create category. Please try again.'
                ], 500);
            }

            return redirect()->back()
                           ->with('error', 'Failed to create category. Please try again.');
        }
    }



    /**
     * Update the specified category in storage.
     */
   public function update(Request $request, Category $category)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('categories')->ignore($category->id)
                ],
                'description' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'boolean',
            ], [
                'name.required' => 'Category name is required.',
                'name.max' => 'Category name cannot exceed 255 characters.',
                'name.unique' => 'This category name already exists.',
                'description.max' => 'Description cannot exceed 1000 characters.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'image.max' => 'The image must not be greater than 2MB.',
            ]);

            // Handle checkbox field (status)
            $validated['status'] = $request->has('status') ? 1 : 0;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }
                
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('categories', $imageName, 'public');
                $validated['image'] = $imagePath;
            }

            $category->update($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Category updated successfully!',
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                        'description' => $category->description,
                        'image' => $category->image,
                        'status' => $category->status,
                        'products_count' => $category->products_count,
                        'created_at' => $category->created_at->format('M d, Y'),
                    ]
                ]);
            }

            return redirect()->route('admin.categories.index')
                           ->with('success', 'Category updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->back()
                           ->withErrors($e->errors())
                           ->withInput();
        } catch (\Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to update category. Please try again.'
                ], 500);
            }

            return redirect()->back()
                           ->with('error', 'Failed to update category. Please try again.');
        }
    }


    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        try {
            // Check if category has products
            $productsCount = $category->products()->count();
            
            if ($productsCount > 0) {
                if (request()->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => "Cannot delete category. It has {$productsCount} product(s) associated with it."
                    ], 400);
                }

                return redirect()->back()
                               ->with('error', "Cannot delete category. It has {$productsCount} product(s) associated with it.");
            }

            $categoryName = $category->name;
            
            // Delete image if it exists
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            
            $category->delete();

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Category '{$categoryName}' deleted successfully!"
                ]);
            }

            return redirect()->route('admin.categories.index')
                           ->with('success', "Category '{$categoryName}' deleted successfully!");
        } catch (\Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete category. Please try again.'
                ], 500);
            }

            return redirect()->back()
                           ->with('error', 'Failed to delete category. Please try again.');
        }
    }

    /**
     * Get category for editing (AJAX)
     */
    public function edit(Category $category)
    {
        try {
            return response()->json([
                'success' => true,
                'category' => [
                    'id' => $category->id,
                    'name' => $category->name,
                    'description' => $category->description,
                    'image' => $category->image,
                    'status' => $category->status,
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching category: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch category data.'
            ], 500);
        }
    }
}
