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

Route::get('/', function () {
    return view('welcome');
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function (){
            Route::get('/admin', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('index');
            Route::resource('users', \App\Http\Controllers\Dashboard\UserController::class)->except(['show']);
            Route::resource('categories', \App\Http\Controllers\Dashboard\CategoryController::class)->except(['show']);
            Route::resource('products', \App\Http\Controllers\Dashboard\ProductController::class)->except(['show']);
            Route::resource('clients', \App\Http\Controllers\Dashboard\ClientController::class)->except(['show']);
            Route::resource('clients.orders', \App\Http\Controllers\Dashboard\Client\OrderController::class)->except(['show']);
            Route::resource('orders', \App\Http\Controllers\Dashboard\OrderController::class);
            Route::get('/orders/{order}/products', [\App\Http\Controllers\Dashboard\OrderController::class , 'products'])->name('orders.products');

        });
});



Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
