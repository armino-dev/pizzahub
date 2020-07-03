<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', 'Frontend\IndexController@index')->name('home');
Route::get('/about', 'Frontend\IndexController@about')->name('about');

Route::get('/basket', 'Frontend\BasketController@view')->name('basket');
Route::get('/basket/step1', 'Frontend\BasketController@step1')->name('basket.step1');
Route::post('/basket/step2', 'Frontend\BasketController@step2')->name('basket.step2');
Route::get('/basket/review', 'Frontend\BasketController@review')->name('basket.review');

Route::post('/basket/item', 'Frontend\BasketController@add')->name('basket.item.store');
Route::delete('/basket/item', 'Frontend\BasketController@delete')->name('basket.item.delete');
Route::patch('/basket/item', 'Frontend\BasketController@update')->name('basket.item.update');



// Simple route for ajax currency change - no need for a controller
Route::post('/settings/currency', function () {
    $valid = request()->validate([
         'currency' => 'string|in:eur,usd'
    ]);
    
    session()->put('currency', $valid['currency']);
    session()->save();
    
    return json_encode(['status' => 'success']);
});

Route::get('/order', 'Frontend\OrderController@store')->name('order.store');
// Route::get('/order', 'Frontend\IndexController@show')->name('order.show');
// Route::post('/order', 'Frontend\OrderController@store')->name('order.store');
// Route::post('/order/item', 'Frontend\BasketController@add')->name('order.product.store');

Auth::routes();

Route::get('/{category}', 'Frontend\ProductController@show')->name('products.show');
Route::get('/{category}/{product}', 'Frontend\ProductController@show')->name('product.show');


// Authenticated Routes
Route::group(['middleware' => ['auth']], function () {

    // user dashboard routes
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'Frontend\DashboardController@index')->name('dashboard');
        Route::get('/orders', 'Frontend\DashboardController@orders')->name('dashboard.orders');
        Route::get('/profile', 'Frontend\DashboardController@profile')->name('dashboard.profile');
    });

    // admin backend routes
    Route::group(['prefix' => 'admin'], function () {

    });
});

