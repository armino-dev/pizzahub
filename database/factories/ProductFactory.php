<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->unique()->colorName;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph,
            'category_id' => Category::factory(),
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat,
            'best_seller' => $this->faker->boolean(20),
        ];
    }
}
