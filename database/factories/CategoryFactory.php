<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->safeColorName;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'icon' => $faker->imageUrl(),
    ];
});
