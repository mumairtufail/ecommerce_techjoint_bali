<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Smartphone',
                'description' => 'High-end smartphone with 128GB storage',
                'price' => 699.99,
                'stock' => 50,
                'image' => 'smartphone.jpg',
                'status' => true,
                'category_name' => 'Electronics',
            ],
            [
                'name' => 'Jeans',
                'description' => 'Comfortable and stylish jeans',
                'price' => 49.99,
                'stock' => 100,
                'image' => 'jeans.jpg',
                'status' => true,
                'category_name' => 'Clothing',
            ],
            [
                'name' => 'Novel',
                'description' => 'Best-selling fiction novel',
                'price' => 19.99,
                'stock' => 200,
                'image' => 'novel.jpg',
                'status' => true,
                'category_name' => 'Books',
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category_name'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']),
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'image' => $product['image'],
                    'status' => $product['status'],
                ]);
            }
        }
    }
}
