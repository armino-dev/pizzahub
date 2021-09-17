<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        $name = $this->faker->unique()->safeColorName;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => $this->faker->imageUrl(),
        ];
    }
}
