<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        if (! $user) {
            return redirect(route('home'));
        }

        return view('frontend.dashboard.profile', compact('user'));
    }
}
