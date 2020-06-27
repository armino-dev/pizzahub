<?php

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
Route::get('/', 'Frontend\IndexController@index')->name('home');
Route::get('/{category}/{product}', 'Frontend\ProductController@show')->name('product.show');
Route::get('/checkout', 'Frontend\IndexController@checkout')->name('checkout');

Route::post('/order', 'Frontend\OrderController@add')->name('order.add');

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


Auth::routes();
