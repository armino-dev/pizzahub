<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public routes

Route::get('/', [App\Http\Controllers\Frontend\Pages\IndexController::class, 'show'])->name('home');
Route::get('/about', [App\Http\Controllers\Frontend\Pages\AboutController::class, 'show'])->name('about');
Route::get('/contact', [App\Http\Controllers\Frontend\Pages\ContactController::class, 'show'])->name('contact');

Route::get('/basket', [App\Http\Controllers\Frontend\Basket\BasketController::class, 'show'])->name('basket');
Route::get('/basket/step1', [App\Http\Controllers\Frontend\Basket\StepOneController::class, 'show'])->name('basket.step1');
Route::post('/basket/step2', [App\Http\Controllers\Frontend\Basket\StepTwoController::class, 'store'])->name('basket.step2');
Route::get('/basket/review', [App\Http\Controllers\Frontend\Basket\ReviewController::class, 'show'])->name('basket.review');

Route::post('/basket/item', [App\Http\Controllers\Frontend\Basket\ItemController::class, 'store'])->name('basket.item.store');
Route::delete('/basket/item', [App\Http\Controllers\Frontend\Basket\ItemController::class, 'delete'])->name('basket.item.delete');
Route::patch('/basket/item', [App\Http\Controllers\Frontend\Basket\ItemController::class, 'update'])->name('basket.item.update');

// Simple route for ajax currency change - no need for a controller
Route::post('/settings/currency', function () {
    $valid = request()->validate([
        'currency' => 'string|in:eur,usd',
    ]);

    session()->put('currency', $valid['currency']);
    session()->save();

    return json_encode(['status' => 'success']);
});

Route::get('/order', [App\Http\Controllers\Frontend\Order\OrderController::class, 'store'])->name('order.store');

// Authenticated Routes
Route::group(['middleware' => ['auth']], function () {
    // user dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [App\Http\Controllers\Frontend\Dashboard\DashboardController::class, 'show'])->name('dashboard');
        Route::get('/orders', [App\Http\Controllers\Frontend\Dashboard\OrderController::class, 'show'])->name('dashboard.orders');
        Route::get('/profile', [App\Http\Controllers\Frontend\Dashboard\ProfileController::class, 'show'])->name('dashboard.profile');
    });

    // admin backend routes
    Route::group(['prefix' => 'admin'], function () {
        // for the future
    });
});

// Register auth routes
Auth::routes();

Route::get('/{category}', [App\Http\Controllers\Frontend\CategoryController::class, 'show'])->name('category.show');
Route::get('/{category}/{product}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product.show');
