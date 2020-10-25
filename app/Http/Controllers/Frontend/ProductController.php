<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductController extends Controller
{
    public function show(Category $category, Product $product)
    {
        $user = auth()->user();
        if ($category->id != $product->category_id) {
            throw new HttpException(Response::HTTP_BAD_REQUEST, __('Product doesn\'t belong to this category'));
        }

        return view('frontend.product', compact('user', 'product'));
    }
}
