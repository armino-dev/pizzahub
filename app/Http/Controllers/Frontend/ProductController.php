<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Category $category, Product $product = null)
    {
        $user = auth()->user();
        $categories = Category::all();
        if ($product != null) {
            return view('frontend.product', compact('user', 'category', 'product'));
        }

        $products = Product::where('category_id', $category['id'])->latest()->get();

        return view('frontend.category', compact('user', 'categories', 'category', 'products'));
    }
}
