<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->colorName;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'description' =>  $faker->paragraph,
        'category_id' => factory(App\Models\Category::class),
        'image' => $faker->imageUrl,
        'price' => $faker->randomFloat,
        'best_seller' => $faker->boolean(20)
    ];
});
