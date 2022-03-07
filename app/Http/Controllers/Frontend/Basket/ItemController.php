<?php

namespace App\Http\Controllers\Frontend\Basket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\Item\DeleteRequest;
use App\Http\Requests\Basket\Item\StoreRequest;
use App\Http\Requests\Basket\Item\UpdateRequest;
use App\Models\Basket;
use App\Models\Product;

class ItemController extends Controller
{
    public function store(StoreRequest $request)
    {
        $validation = $request->validated();

        $product = Product::find($validation['product-id']);

        $basket = session()->has('basket') ? session()->get('basket') : null;

        $newBasket = new Basket($basket);
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $validation['item-quantity'],
            'price' => $product->price,
        ];
        $newBasket->add($item, $product->id);

        session()->put('basket', $newBasket);

        $message = $product->name.' was added to your basket.';

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message];
        }

        return redirect(route('home'))->with(['message' => $message]);
    }

    public function delete(DeleteRequest $request)
    {
        $validation = $request->validated();

        $product = Product::find($validation['product-id']);

        $basket = session()->has('basket') ? session()->get('basket') : null;

        $newBasket = new Basket($basket);

        $newBasket->delete($product->id);

        session()->put('basket', $newBasket);

        $message = $product->name.' was deleted from your basket.';

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message, 'status' => 'success'];
        }

        return redirect(route('home'))->with(['message' => $message]);
    }

    public function update(UpdateRequest $request)
    {
        $validation = $request->validated();

        $product = Product::find($validation['product-id']);

        $basket = session()->has('basket') ? session()->get('basket') : null;

        $newBasket = new Basket($basket);
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'quantity' => $validation['item-quantity'],
            'price' => $product->price,
        ];
        $newBasket->update($item);

        session()->put('basket', $newBasket);

        $message = $product->name.' quantity updated.';

        if ($request->wantsJson()) {
            return ['path' => route('home'), 'message' => $message, 'status' => 'success'];
        }

        return redirect(route('home'))->with(['message' => $message]);
    }
}
