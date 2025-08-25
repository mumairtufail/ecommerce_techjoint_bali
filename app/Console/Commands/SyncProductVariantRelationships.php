<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class SyncProductVariantRelationships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:sync-variant-relationships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync product color and size relationships based on existing variants';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to sync product variant relationships...');
        
        $products = Product::with('variants')->get();
        $syncedCount = 0;
        
        foreach ($products as $product) {
            if ($product->variants->count() > 0) {
                $colorIds = [];
                $sizeIds = [];
                
                foreach ($product->variants as $variant) {
                    if ($variant->color_id) {
                        $colorIds[] = $variant->color_id;
                    }
                    if ($variant->size_id) {
                        $sizeIds[] = $variant->size_id;
                    }
                }
                
                // Sync colors and sizes
                if (!empty($colorIds)) {
                    $product->colors()->sync(array_unique($colorIds));
                    $this->info("Synced " . count(array_unique($colorIds)) . " colors for product: {$product->name}");
                }
                
                if (!empty($sizeIds)) {
                    $product->sizes()->sync(array_unique($sizeIds));
                    $this->info("Synced " . count(array_unique($sizeIds)) . " sizes for product: {$product->name}");
                }
                
                $syncedCount++;
            }
        }
        
        $this->info("Successfully synced relationships for {$syncedCount} products.");
        
        return 0;
    }
}
