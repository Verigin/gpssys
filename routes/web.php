<?php

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'Home\HomeController@index')->name('home');

    Route::get('/home/orders/', 'Home\OrderController@index')->name('home.orders');
    Route::get('/home/orders/{id}', 'Home\OrderController@show')->name('home.orders.show');
    Route::get('/home/orders/delete/{id}', 'Home\OrderController@delete')->name('home.orders.delete');

    Route::get('/home/info/', 'Home\InfoController@index')->name('home.info');
    Route::post('/home/info/', 'Home\InfoController@update');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'Admin\AdminController@index')->name('admin');

    Route::get('/admin/categories', 'Admin\CategoryController@index')->name('categories');
    Route::get('/admin/categories/create', 'Admin\CategoryController@create')->name('categories.create');
    Route::post('/admin/categories/create', 'Admin\CategoryController@store');
    Route::get('/admin/categories/edit/{id}', 'Admin\CategoryController@edit')->where('id', '\d+')->name('categories.edit');
    Route::post('/admin/categories/edit/{id}', 'Admin\CategoryController@update')->where('id', '\d+');
    Route::get('/admin/categories/delete{id}', 'Admin\CategoryController@delete')->where('id', '\d+')->name('categories.delete');

    Route::get('/admin/products', 'Admin\ProductController@index')->name('products');
    Route::get('/admin/products/create', 'Admin\ProductController@create')->name('products.create');
    Route::post('/admin/products/create', 'Admin\ProductController@store');
    Route::get('/admin/products/edit/{id}', 'Admin\ProductController@edit')->where('id', '\d+')->name('products.edit');
    Route::post('/admin/products/edit/{id}', 'Admin\ProductController@update')->where('id', '\d+');
    Route::get('/admin/products/delete/{id}', 'Admin\ProductController@delete')->where('id', '\d+')->name('products.delete');

    Route::get('/admin/orders', 'Admin\OrderController@index')->name('orders');
    Route::get('/admin/orders/{id}', 'Admin\OrderController@show')->name('orders.show');
    Route::get('/admin/orders/delete/{id}', 'Admin\OrderController@delete')->name('orders.delete');
});

Route::get('/shop', 'ShopController@index')->name('shop');
Route::get('/shop/{id}', 'ShopController@show')->name('shop.item');

Route::get('/cart', 'CartController@index')->name('cart');

Route::post('/cart', 'CartController@add')->name('cart.add');
Route::post('/cart/update/{id}', 'CartController@update')->name('cart.update');
Route::post('/cart/delete/{id}', 'CartController@delete')->name('cart.delete');
Route::get('/cart/details', 'CartController@details')->name('cart.details');

Route::get('/cart/order', 'CartController@order')->name('cart.order');
