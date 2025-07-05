<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 2,
                'name' => 'Blue And White Cape Shawl',
                'description' => 'Elegant blue and white cape shawl for women.',
                'price' => 250.00,
                'stock' => 10,
                'image' => 'products/iXYZv1d23sa5qj391nuLL9h2dVR94V5bdZx0s3rG.png',
                'status' => true,
            ],
           
        ];

        DB::table('products')->insert($products);
    }
}
