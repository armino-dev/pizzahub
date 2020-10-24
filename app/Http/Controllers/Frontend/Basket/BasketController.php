<?php

namespace App\Http\Controllers\Frontend\Basket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function show(Request $request)
    {
        $basket = session()->has('basket') ? session()->get('basket') : null;

        return view('frontend.checkout', compact('basket'));
    }
}
