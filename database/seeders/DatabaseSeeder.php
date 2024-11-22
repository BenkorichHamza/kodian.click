<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Brand::factory(12)->create();

        Product::factory(100)->create();

        Category::factory(8)->create();
        Brand::factory(15)->create();
        Product::all()->each(function ($product) {
            $product->categories()->attach(Category::all()->random(rand(1, 4))->pluck('id'));
            $product->brand()->associate(Brand::all()->random());
        });
    }
}
