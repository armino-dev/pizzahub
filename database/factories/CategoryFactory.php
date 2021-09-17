<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->unique()->safeColorName;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'icon' => $faker->imageUrl(),
    ];
});
