<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductSize;
use App\Models\ProductColor;

class ProductVariantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default sizes
        $sizes = [
            ['name' => 'XS', 'display_name' => 'Extra Small', 'sort_order' => 1],
            ['name' => 'S', 'display_name' => 'Small', 'sort_order' => 2],
            ['name' => 'M', 'display_name' => 'Medium', 'sort_order' => 3],
            ['name' => 'L', 'display_name' => 'Large', 'sort_order' => 4],
            ['name' => 'XL', 'display_name' => 'Extra Large', 'sort_order' => 5],
            ['name' => 'XXL', 'display_name' => 'Double Extra Large', 'sort_order' => 6],
            ['name' => '3XL', 'display_name' => 'Triple Extra Large', 'sort_order' => 7],
        ];

        foreach ($sizes as $size) {
            ProductSize::firstOrCreate(
                ['name' => $size['name']], 
                $size
            );
        }

        // Create default colors
        $colors = [
            ['name' => 'Black', 'hex_code' => '#000000', 'sort_order' => 1],
            ['name' => 'White', 'hex_code' => '#FFFFFF', 'sort_order' => 2],
            ['name' => 'Red', 'hex_code' => '#FF0000', 'sort_order' => 3],
            ['name' => 'Blue', 'hex_code' => '#0000FF', 'sort_order' => 4],
            ['name' => 'Green', 'hex_code' => '#008000', 'sort_order' => 5],
            ['name' => 'Yellow', 'hex_code' => '#FFFF00', 'sort_order' => 6],
            ['name' => 'Purple', 'hex_code' => '#800080', 'sort_order' => 7],
            ['name' => 'Orange', 'hex_code' => '#FFA500', 'sort_order' => 8],
            ['name' => 'Pink', 'hex_code' => '#FFC0CB', 'sort_order' => 9],
            ['name' => 'Gray', 'hex_code' => '#808080', 'sort_order' => 10],
            ['name' => 'Brown', 'hex_code' => '#A52A2A', 'sort_order' => 11],
            ['name' => 'Navy', 'hex_code' => '#000080', 'sort_order' => 12],
        ];

        foreach ($colors as $color) {
            ProductColor::firstOrCreate(
                ['name' => $color['name']], 
                $color
            );
        }
    }
}
