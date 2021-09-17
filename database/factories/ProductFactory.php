<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->unique()->colorName;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' =>  $faker->paragraph,
        'category_id' => Category::factory(),
        'image' => $faker->imageUrl,
        'price' => $faker->randomFloat,
        'best_seller' => $faker->boolean(20),
    ];
});
