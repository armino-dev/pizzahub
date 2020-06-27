<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function show($category, $product)
    {
        $user = auth()->user();
        $category = Category::where('name', $category)->firstOrFail();
        $product = Product::where('slug', $product)->firstOrFail();
        
        return view('frontend.product', compact('user', 'category', 'product'));
    }
}