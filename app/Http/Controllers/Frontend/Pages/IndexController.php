<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    //
    public function show()
    {
        $user = auth()->user();
        $categories = Category::all();
        $menus = collect();

        // lets get 3 items from each category to display on first page
        $categories->each(function ($category) use (&$menus) {
            $menus->put(
                $category->name,
                Cache::remember("best-sellers-from-category-$category->id", now()->addDay(), function () use ($category) {
                    return Product::with('category')
                        ->where('category_id', $category->id)
                        ->get()
                        ->sortByDesc('best_seller')
                        ->take(3);
                })
            );
        });

        if (! session()->has('currency')) {
            session()->put('currency', 'eur');
        }

        return view('index', compact('user', 'categories', 'menus'));
    }
}
