<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            1 => ['Pizzas', 'fas fa-pizza-slice'],
            2 => ['Desserts', 'fas fa-birthday-cake'],
            3 => ['Drinks', 'fas fa-beer'],
        ];

        foreach ($categories as $key => $value) {
            $category = new Category();
            $category->unguard();
            $category->id = $key;
            $category->slug = strtolower($value[0]);
            $category->name = $value[0];
            $category->icon = $value[1];
            $category->save();
        }
    }
}
