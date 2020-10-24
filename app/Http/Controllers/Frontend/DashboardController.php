<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect(route('home'));
        }
        $orders = $user->orders;

        return view('frontend.dashboard', compact('user', 'orders'));
    }

    public function orders()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect(route('home'));
        }
        $orders = $user->orders;

        return view('frontend.dashboard.orders', compact('user', 'orders'));
    }

    public function profile()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect(route('home'));
        }

        return view('frontend.dashboard.profile', compact('user'));
    }
}
