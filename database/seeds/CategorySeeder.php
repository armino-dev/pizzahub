<?php

use App\Category;
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
            1 => 'Pizzas',
            2 => 'Desserts',
            3 => 'Drinks',
        ];

        foreach($categories as $key => $value) {
            $category = new Category();
            $category->unguard();
            $category->id = $key;
            $category->name = $value;
            $category->save();
        }
    }
}
