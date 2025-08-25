<?php
/**
 * Test script to check product relationships
 * Run this from the command line: php test_relationships.php
 */

// Include Laravel bootstrap
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;

try {
    echo "Testing Product Relationships...\n\n";
    
    // Test 1: Check if colors table has data
    echo "1. Checking ProductColor table:\n";
    $colors = ProductColor::all();
    echo "   Found " . $colors->count() . " colors\n";
    if ($colors->count() > 0) {
        echo "   Colors: " . $colors->pluck('name')->implode(', ') . "\n";
    }
    echo "\n";
    
    // Test 2: Check if sizes table has data
    echo "2. Checking ProductSize table:\n";
    $sizes = ProductSize::all();
    echo "   Found " . $sizes->count() . " sizes\n";
    if ($sizes->count() > 0) {
        echo "   Sizes: " . $sizes->pluck('name')->implode(', ') . "\n";
    }
    echo "\n";
    
    // Test 3: Check first product and its relationships
    echo "3. Checking Product relationships:\n";
    $product = Product::with(['colors', 'sizes', 'variants'])->first();
    
    if ($product) {
        echo "   Product: {$product->name} (ID: {$product->id})\n";
        echo "   Colors assigned: " . $product->colors->count() . "\n";
        if ($product->colors->count() > 0) {
            echo "   Color names: " . $product->colors->pluck('name')->implode(', ') . "\n";
        }
        echo "   Sizes assigned: " . $product->sizes->count() . "\n";
        if ($product->sizes->count() > 0) {
            echo "   Size names: " . $product->sizes->pluck('name')->implode(', ') . "\n";
        }
        echo "   Variants: " . $product->variants->count() . "\n";
    } else {
        echo "   No products found\n";
    }
    echo "\n";
    
    // Test 4: Test the exact code used in the controller
    echo "4. Testing controller logic:\n";
    if ($product) {
        $variantsArray = $product->variants->map(function($variant) use ($product) {
            return [
                'id' => $variant->id,
                'size_id' => $variant->size_id,
                'color_id' => $variant->color_id,
                'stock' => $variant->stock,
                'price_adjustment' => $variant->price_adjustment ?? 0,
                'final_price' => $product->price + ($variant->price_adjustment ?? 0),
                'size_name' => optional($variant->size)->name,
                'color_name' => optional($variant->color)->name,
                'color_hex' => optional($variant->color)->hex_code,
            ];
        })->toArray();
        
        echo "   Variants array count: " . count($variantsArray) . "\n";
        foreach ($variantsArray as $variant) {
            echo "   - Variant {$variant['id']}: {$variant['color_name']} (Stock: {$variant['stock']}, Price: \${$variant['final_price']})\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
