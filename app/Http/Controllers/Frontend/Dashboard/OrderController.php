<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect(route('home'));
        }
        $orders = $user->orders;

        return view('frontend.dashboard.orders', compact('user', 'orders'));
    }
}
