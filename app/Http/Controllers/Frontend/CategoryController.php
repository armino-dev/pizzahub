<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function show(?Category $category = null)
    {
        $user = auth()->user();

        $allCategories = Cache::remember('categories', now()->addDay(), function () {
            return Category::all();
        });

        $categories = $category->exists ? $allCategories : collect();

        $cacheKey = 'products-on-category-' . $category['id'];
        $products = Cache::remember($cacheKey, now()->addDay(), function ($category) {
            return Product::where('category_id', $category['id'])->latest()->get();
        });

        return view('frontend.category', compact('user', 'categories', 'category', 'products'));
    }
}
