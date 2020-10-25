<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show(?Category $category = null)
    {
        $user = auth()->user();
        $categories = $category->exists ? Category::all() : collect();

        $products = Product::where('category_id', $category['id'])->latest()->get();

        return view('frontend.category', compact('user', 'categories', 'category', 'products'));
    }
}
