<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $user = auth()->user();
        return view('frontend.dashboard', compact('user'));
    }

    public function orders() {
        $user = auth()->user();
        return view('frontend.dashboard.orders', compact('user'));
    }

    public function profile() {
        $user = auth()->user();
        return view('frontend.dashboard.profile', compact('user'));
    }
}
