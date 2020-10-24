<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect(route('home'));
        }
        $orders = $user->orders;

        return view('frontend.dashboard', compact('user', 'orders'));
    }
}
