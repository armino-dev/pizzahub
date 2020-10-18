<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            // Pizzas
            [
                'name' => 'Rustica',
                'description' => 'Tomato Sauce, 100% Mozzarella, Pepperoni, Sausage, Onions, Green Peppers',
                'category' => 1,
                'image' => 'pizza-rustica.jpg',
                'price' => 7.99,
            ],
            [
                'name' => 'Cheddar Melt',
                'description' => 'Tomato Sauce, 100% Mozzarella, Extra Cheddar, Bacon, Mushrooms',
                'category' => 1,
                'image' => 'pizza-cheddar.jpg',
                'price' => 6.99,
            ],
            [
                'name' => 'Capricciosa',
                'description' => 'Tomato Sauce, 100% Mozzarella, Ham, Mushrooms, Fresh Tomato',
                'category' => 1,
                'image' => 'pizza-capricciosa.jpg',
                'price' => 7.49,
            ],
            [
                'name' => 'Quattro Stagioni',
                'description' => 'Tomato Sauce, 100% Mozzarella, Ham, Chorizo, Green Peppers, Mushrooms',
                'category' => 1,
                'image' => 'pizza-quattro-stagioni.jpg',
                'price' => 9.99,
                'best_seller' => true,
            ],
            [
                'name' => 'Quattro Formaggi',
                'description' => 'Tomato Sauce, 100% Mozzarella, Parmeggiano Reggiano, Cheddar, Feta Cheese',
                'category' => 1,
                'image' => 'pizza-quattro-formaggi.jpg',
                'price' => 8.89,
            ],
            [
                'name' => 'Diavola',
                'description' => 'Tomato Sauce, 100% Mozzarella, Pepperoni, Chorizo, Fresh Tomatoes, Black Olives',
                'category' => 1,
                'image' => 'pizza-diavola.jpg',
                'price' => 7.99,
            ],
            [
                'name' => 'Mexicana',
                'description' => 'Tomato Sauce, 100% Mozzarella, Ham, Bacon, Chorizo, Jalapeno Peppers',
                'category' => 1,
                'image' => 'pizza-mexicana.jpg',
                'price' => 6.99,
            ],
            [
                'name' => 'Margherita',
                'description' => 'Tomato Sauce, 100% Mozzarella',
                'category' => 1,
                'image' => 'pizza-margherita.jpg',
                'price' => 5.49,
            ],
            // Desserts
            [
                'name' => 'Choco Pizza',
                'description' => 'Fresh oven baked puff pastry filled with Nuttela spread and sprinkled with powder sugar.',
                'category' => 2,
                'image' => 'choco-pizza.jpg',
                'price' => 15.49,
            ],
            [
                'name' => 'Choco Lava',
                'description' => 'Chocolate lava cake filled with melted warm chocolate.',
                'category' => 2,
                'image' => 'choco-lava.jpg',
                'price' => 3.49,
            ],
            [
                'name' => 'Ice cream',
                'description' => 'Vanilla ice cream with almonds and walnuts.',
                'category' => 2,
                'image' => 'ice-cream.jpg',
                'price' => 3.49,
            ],
            // Drinks
            [
                'name' => 'Coca Cola',
                'description' => '350ml Coca Cola',
                'category' => 3,
                'image' => 'coca-cola.jpg',
                'price' => 1.49,
                'best_seller' => true,
            ],
            [
                'name' => 'Pepsi Cola',
                'description' => '350ml Pepsi Cola',
                'category' => 3,
                'image' => 'pepsi-cola.jpg',
                'price' => 1.49,
            ],
            [
                'name' => 'Amstel Beer',
                'description' => '500ml Amstel Beer',
                'category' => 3,
                'image' => 'amstel.jpg',
                'price' => 2.49,
            ],
            [
                'name' => 'Ursus Beer',
                'description' => '500ml Ursus Beer',
                'category' => 3,
                'image' => 'ursus-retro.jpg',
                'price' => 2.49,
            ],
        ];

        foreach ($products as $value) {
            $product = new Product();
            $product->name = $value['name'];
            $product->slug = Str::slug($value['name']);
            $product->description = $value['description'];
            $product->category_id = $value['category'];
            $product->image = $value['image'];
            $product->price = $value['price'];
            if (array_key_exists('best_seller', $value)) {
                $product->best_seller = $value['best_seller'];
            }
            $product->save();
        }
    }
}
