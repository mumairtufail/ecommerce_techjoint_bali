<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function index()
    {
        $colors = ProductColor::orderBy('sort_order')->get();
        return view('admin.colors.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_colors',
            'hex_code' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'sort_order' => 'required|integer|min:0',
        ]);

        ProductColor::create($request->all());

        return redirect()->route('admin.colors.index')
            ->with('success', 'Color created successfully!');
    }

    public function update(Request $request, ProductColor $color)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:product_colors,name,' . $color->id,
            'hex_code' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'sort_order' => 'required|integer|min:0',
        ]);

        $color->update($request->all());

        return redirect()->route('admin.colors.index')
            ->with('success', 'Color updated successfully!');
    }

    public function destroy(ProductColor $color)
    {
        if ($color->variants()->count() > 0) {
            return redirect()->route('admin.colors.index')
                ->with('error', 'Cannot delete color that has product variants!');
        }

        $color->delete();

        return redirect()->route('admin.colors.index')
            ->with('success', 'Color deleted successfully!');
    }

    public function toggleStatus(ProductColor $color)
    {
        $color->update(['status' => !$color->status]);

        return response()->json([
            'success' => true,
            'status' => $color->status
        ]);
    }
}
