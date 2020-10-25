<?php

namespace App\Http\Controllers\Frontend\Basket;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show(Request $request)
    {
        if (! session()->has('basket') || ! session()->has('order-detail')) {
            return redirect(route('home'));
        }
        $basket = new Basket(session()->get('basket'));
        $orderDetail = session()->get('order-detail');

        return view('frontend.checkout-review', compact('basket', 'orderDetail'));
    }
}
