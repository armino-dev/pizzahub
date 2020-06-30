<?php

namespace App\Http\Controllers\Frontend;

use App\Basket;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;


class BasketController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $validation = $request->validate(
            [
                'product-id' => 'numeric|required|exists:App\Product,id',                
                'item-quantity' => 'integer|required|min:1|max:100',
            ]
        );
        
        $sessionId = session()->getId();
        
        $product = Product::find($validation['product-id']);

        $basket = session()->has('basket') ? session()->get('basket') : null;
        
        $newBasket = new Basket($basket);
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $validation['item-quantity'],
            'price' => $product->price
        ];
        $newBasket->add($item, $product->id);
        
        session()->put('basket', $newBasket);

        $message = $product->name . " was added to your basket.";

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message];
        }
        
        return redirect(route('home'))->with(['message' => $message]);
    }

    public function delete(Request $request)
    {

    }

    public function empty() {

    }

    public function checkout(Request $request)
    {
        $basket = session()->has('basket') ? session()->get('basket') : 'null';
        return view('frontend.checkout', compact('basket'));
    }
}
