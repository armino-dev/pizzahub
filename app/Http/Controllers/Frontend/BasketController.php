<?php

namespace App\Http\Controllers\Frontend;

use App\Basket;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;


class BasketController extends Controller
{
    public function add(Request $request)
    {
        $validation = $request->validate(
            [
                'product-id' => 'numeric|required|exists:App\Product,id',                
                'item-quantity' => 'integer|required|min:1|max:100',
            ]
        );
        
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
        $validation = $request->validate(
            [
                'product-id' => 'numeric|required|exists:App\Product,id',
            ]
        );
        $product = Product::find($validation['product-id']);

        $basket = session()->has('basket') ? session()->get('basket') : null;
        
        $newBasket = new Basket($basket);
        
        $newBasket->delete($product->id);
        
        session()->put('basket', $newBasket);

        $message = $product->name . " was deleted from your basket.";

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message, 'status' => 'success'];
        }
        
        return redirect(route('home'))->with(['message' => $message]);
    }

    public function empty() {

    }

    public function view(Request $request)
    {
        $basket = session()->has('basket') ? session()->get('basket') : 'null';
        return view('frontend.checkout', compact('basket'));
    }

    public function step1(Request $request)
    {
        $basket = session()->has('basket') ? session()->get('basket') : 'null';
        return view('frontend.checkout-step1', compact('basket'));
    }

    public function update(Request $request)
    {
        $validation = $request->validate(
            [
                'product-id' => 'numeric|required|exists:App\Product,id',                
                'item-quantity' => 'integer|required|min:1|max:100',
            ]
        );
        
        $product = Product::find($validation['product-id']);

        $basket = session()->has('basket') ? session()->get('basket') : null;
        
        $newBasket = new Basket($basket);
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $validation['item-quantity'],
            'price' => $product->price
        ];
        $newBasket->update($item);
        
        session()->put('basket', $newBasket);

        $message = $product->name . " quantity updated.";

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message, 'status' => 'success'];
        }
        
        return redirect(route('home'))->with(['message' => $message]);
    }

    public function step2(Request $request)
    {
        $validation = $request->validate(
            [
                'email' => 'required|email',
                'phone' => 'required|min:4|max:14',
                'name' => 'required|min:3|max:50',
                'address' => 'required|min:10|max:255',
                'city' => 'required|in:bucharest,bragadiru',
                'zip' => 'required|min:3|max:10',
            ]
        );
        

        session()->put('order-detail', $validation);

        $message = "Delivery details set.";

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message, 'status' => 'success'];
        }
        
        return redirect(route('basket.review'))->with(['message' => $message]);
    }

    public function review(Request $request)
    {
        if (!session()->has('basket') || !session()->has('order-detail')) {
            return redirect(route('home'));
        }
        $basket = new Basket(session()->get('basket'));
        $orderDetail = session()->get('order-detail');

        return view('frontend.checkout-review', compact('basket', 'orderDetail'));
    }

}
