<?php

namespace Database\Seeders;

use App\Models\ProductApi;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'usertype' => 'admin',
            'password' => Hash::make('password'),
        ]);
        $this->call([
            AttributeSeeder::class,
        ]);

        Category::create(['title' => 'Category 1', 'slug' => 'category-1', 'description' => 'Description 1', 'is_active' => 1]);

        Product::create(
            [
                'title' => 'Product 1',
                'category_id' => 1,
                'attribute_id' => 3,
                'description' => 'Product 1',
                'image' => 'images/products/1717760435.jpg',
                'price' => 1241,
                'quantity' => 10,
                'is_active' => 1,
                'slug' => 'product-1',
            ]
        );
        Product::create(
        [
            'title' => 'Product 1',
            'category_id' => 1,
            'attribute_id' => 3,
            'description' => 'Product 1',
            'image' => 'images/products/1717760435.jpg',
            'price' => 12141,
            'quantity' => 10,
            'is_active' => 1,
            'slug' => 'product-2',
        ]
    );


        ProductApi::create(
            [
                'title' => 'Product 1',
                'category_id' => 1,
                'attribute_id' => 3,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 1241,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 2',
                'category_id' => 1,
                'attribute_id' => 2,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 100,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 3',
                'category_id' => 1,
                'attribute_id' => 3,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 12341,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 4',
                'category_id' => 1,
                'attribute_id' => 5,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 3414,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 5',
                'category_id' => 1,
                'attribute_id' => 1,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 4151,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 6',
                'category_id' => 1,
                'attribute_id' => 4,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 11111,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 7',
                'category_id' => 1,
                'attribute_id' => 5,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 4555,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 8',
                'category_id' => 1,
                'attribute_id' => 1,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 1000,
                'quantity' => 124,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 9',
                'category_id' => 1,
                'attribute_id' => 2,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 5000,
                'quantity' => 10,
            ]
        );
        ProductApi::create(
            [
                'title' => 'Product 10',
                'category_id' => 1,
                'attribute_id' => 3,
                'description' => 'Product 1',
                'image' => 'Product 1',
                'price' => 5555,
                'quantity' => 10,
            ]
        );
    }
}
