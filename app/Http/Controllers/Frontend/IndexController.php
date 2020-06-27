<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $category = request()->has('category') ? Category::findOrFail(request()->category) : Category::whereName('Pizzas')->first();
        $products = Product::where('category_id', $category['id'])->latest()->get();   
        return view('index', compact('user', 'category', 'products'));
    }

    public function about()
    {
        return view('index', compact('user'));
    }

    public function contact()
    {
        return view('index', compact('user'));
    }
}
