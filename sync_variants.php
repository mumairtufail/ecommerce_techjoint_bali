<?php
/**
 * Script to sync product variant relationships
 * Run this from the command line: php sync_variants.php
 */

// Include Laravel bootstrap
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;

try {
    echo "Starting to sync product variant relationships...\n\n";
    
    $products = Product::with('variants')->get();
    $syncedCount = 0;
    
    foreach ($products as $product) {
        if ($product->variants->count() > 0) {
            echo "Processing product: {$product->name} (ID: {$product->id})\n";
            echo "  Found {$product->variants->count()} variants\n";
            
            $colorIds = [];
            $sizeIds = [];
            
            foreach ($product->variants as $variant) {
                echo "  - Variant {$variant->id}: color_id={$variant->color_id}, size_id={$variant->size_id}\n";
                
                if ($variant->color_id) {
                    $colorIds[] = $variant->color_id;
                }
                if ($variant->size_id) {
                    $sizeIds[] = $variant->size_id;
                }
            }
            
            // Sync colors and sizes
            if (!empty($colorIds)) {
                $uniqueColorIds = array_unique($colorIds);
                $product->colors()->sync($uniqueColorIds);
                echo "  Synced " . count($uniqueColorIds) . " colors: " . implode(', ', $uniqueColorIds) . "\n";
            }
            
            if (!empty($sizeIds)) {
                $uniqueSizeIds = array_unique($sizeIds);
                $product->sizes()->sync($uniqueSizeIds);
                echo "  Synced " . count($uniqueSizeIds) . " sizes: " . implode(', ', $uniqueSizeIds) . "\n";
            }
            
            $syncedCount++;
            echo "\n";
        }
    }
    
    echo "Successfully synced relationships for {$syncedCount} products.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
