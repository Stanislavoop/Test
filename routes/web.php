<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController as Prod;
use App\Http\Controllers\BasketController as Basket;
use Admin\BasketAdminController as AdminBasket;
use Admin\ProductAdminController as AdminProd;
use Admin\HomeController as AdminHome;

Route::get('/category/{category}', [Prod::class, 'showCategory'])->name('showCategory');
Route::get('/category/{category}/{id}', [Prod::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('getProduct');

Route::get('/basket', [Basket::class, 'basket'])->name('cartBasket');
Route::get('/basket/checkout', [Basket::class, 'order'])->name('cartOrder');

Route::post('/basket/add/{id}', [Basket::class, 'add'])
    ->where('id', '[0-9]+')
    ->name('basketAdd');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['role:admin'])->prefix('admin_panel')->group(function () {
    Route::get('/', [AdminHome::class, 'index'])->name('homeAdmin');
    Route::resource('productAdmin', AdminProd::class);
    Route::resource('basketAdmin', AdminBasket::class);


});
