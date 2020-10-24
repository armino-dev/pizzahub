<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user = auth()->user();
        if (! session()->has('basket') || ! session()->has('order-detail')) {
            return redirect(route('home'));
        }
        $basket = session()->get('basket');
        $orderDetail = session()->get('order-detail');

        $orderItems = [];
        foreach ($basket->getItems() as $key => $value) {
            $item['product_id'] = $key;
            $item['name'] = $value['name'];
            $item['price'] = $value['price'];
            $item['quantity'] = $value['quantity'];
            $orderItems[] = $item;
        }

        $order = new Order();
        $grandTotal = $basket->getTotal();
        $order->address = implode('|', [$orderDetail['address'], $orderDetail['city'], $orderDetail['zip']]);
        $order->vat = config('settings.vat') / 100;
        $order->delivery_cost = config('settings.delivery_cost')[$orderDetail['city']];
        $order->total = $grandTotal;
        $order->session_id = session()->getId();
        $order->email = $orderDetail['email'];
        $order->phone = $orderDetail['phone'];
        if ($user) {
            $order->user_id = $user->id;
        }
        $order->save();
        $order->addItems($orderItems);

        session()->forget(['basket', 'order-detail']);

        // TODO:
        // optional: send email to the user with order detail and invoice

        return redirect(route('home'))->with(['message' => 'Your order was successful and you will receive your food in 15 minutes.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
