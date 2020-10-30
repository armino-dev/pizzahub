<?php

namespace Tests\Feature;

use App\Models\Basket;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BasketTest extends TestCase
{
    use RefreshDatabase;

    public function testABasketCanHaveProducts()
    {
        $product = factory(Product::class)->create(
            [
                'name' => 'My product 2',
                'slug' => \Str::slug('My product 2'),
                'description' => 'Some description',
                'image' => '',
                'category_id' => factory(Category::class)->create(),
                'price' => 12.2,
                'best_seller' => 0,
            ]
        );

        $data = [
            'product-id' => $product->id,
            'item-quantity' => 1,
        ];

        $this->followingRedirects()
            ->post(route('basket.item.store'), $data)
            ->assertSee('Thank you!')
            ->assertSee($product->name);

        $basket = session()->get('basket');
        $this->assertInstanceOf(Basket::class, $basket);
    }

    public function testAnItemFromBasketCanBeUpdated()
    {
        $product = factory(Product::class)->create(
            [
                'name' => 'My product 2',
                'slug' => \Str::slug('My product 2'),
                'description' => 'Some description',
                'image' => '',
                'category_id' => factory(Category::class)->create(),
                'price' => 12.2,
                'best_seller' => 0,
            ]
        );

        $data = [
            'product-id' => $product->id,
            'item-quantity' => 1,
        ];

        $this->followingRedirects()
            ->post(route('basket.item.store'), $data)
            ->assertSee('Thank you!')
            ->assertSee($product->name);

        $basket = session()->get('basket');

        $this->assertEqualsWithDelta(12.2, $basket->getTotal(), 0.0001);
        $this->assertEquals(1, $basket->getQuantity());

        $data = [
            'product-id' => $product->id,
            'item-quantity' => 3,
        ];

        $this->followingRedirects()
            ->post(route('basket.item.store'), $data)
            ->assertSee('Thank you!')
            ->assertSee($product->name);

        $basket = session()->get('basket');

        $this->assertEqualsWithDelta(48.8, $basket->getTotal(), 0.0001);
        $this->assertEquals(4, $basket->getQuantity());
    }

    public function testAnItemFromBasketCanBeDeleted()
    {
        $productOne = factory(Product::class)->create();
        $productTwo = factory(Product::class)->create();

        $data = [
            'product-id' => $productOne->id,
            'item-quantity' => 3,
        ];

        $this->followingRedirects()
            ->post(route('basket.item.store'), $data)
            ->assertSee('Thank you!')
            ->assertSee($productOne->name);

        $basket = session()->get('basket');
        $this->assertEquals(3, $basket->getQuantity());

        $data = [
            'product-id' => $productTwo->id,
            'item-quantity' => 2,
        ];

        $this->followingRedirects()
            ->post(route('basket.item.store'), $data)
            ->assertSee('Thank you!')
            ->assertSee($productTwo->name);

        $basket = session()->get('basket');
        $this->assertEquals(5, $basket->getQuantity());

        $data = [
            'product-id' => $productOne->id,
        ];

        $this->followingRedirects()
            ->delete(route('basket.item.delete'), $data);

        $basket = session()->get('basket');
        $this->assertEquals(2, $basket->getQuantity());
    }
}
