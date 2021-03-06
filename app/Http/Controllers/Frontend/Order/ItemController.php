<?php

namespace App\Http\Controllers\Frontend\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function store(Request $request)
    {
        $validation = $request->validate(
            [
                'product-id' => 'numeric|required|exists:App\Product,id',
                'item-quantity' => 'integer|required|min:1|max:100',
            ]
        );

        $sessionId = $request->session()->getId();

        $product = Product::find($validation['product-id']);

        $order = Order::firstOrNew(['session_id' => $sessionId]);
        $order->session_id = $sessionId;
        $order->vat = 19;
        $order->save();

        $item = new OrderItem();
        $item->price = $product['price'];
        $item->name = $product['name'];

        dd($sessionId, $product, $order);

        return redirect()->route('home')->with(['status' => 'success']);
    }
}
