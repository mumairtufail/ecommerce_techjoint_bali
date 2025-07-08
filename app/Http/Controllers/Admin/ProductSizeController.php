<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public function index()
    {
        $sizes = ProductSize::orderBy('sort_order')->get();
        return view('admin.sizes.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_sizes',
            'display_name' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        ProductSize::create($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Size created successfully!']);
        }

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size created successfully!');
    }

    public function update(Request $request, ProductSize $size)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_sizes,name,' . $size->id,
            'display_name' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['status'] = $request->has('status');

        $size->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Size updated successfully!']);
        }

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size updated successfully!');
    }

    public function destroy(ProductSize $size)
    {
        if ($size->variants()->count() > 0) {
            if (request()->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Cannot delete size that has product variants!']);
            }
            return redirect()->route('admin.sizes.index')
                ->with('error', 'Cannot delete size that has product variants!');
        }

        $size->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Size deleted successfully!']);
        }

        return redirect()->route('admin.sizes.index')
            ->with('success', 'Size deleted successfully!');
    }

    public function toggleStatus(ProductSize $size)
    {
        $size->update(['status' => !$size->status]);

        return response()->json([
            'success' => true,
            'status' => $size->status
        ]);
    }
}
