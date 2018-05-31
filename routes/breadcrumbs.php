<?php
use App\Category;
use App\Product;

// Main
Breadcrumbs::for('main', function ($trail) {
    $trail->push('Main', url('/'));
});

// Shop
Breadcrumbs::for('shop', function ($trail) {
    $trail->parent('main');
    $trail->push('Shop', route('shop'));
});

Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('main');
    $trail->push('Cart', route('shop'));
});

Breadcrumbs::for('shop.item', function ($trail, $id) {
    $trail->parent('shop');
    $data = Product::findOrFail($id);
    $trail->push($data->title, route('shop.item', $id));
});

//Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('home.orders', function ($trail) {
    $trail->parent('home');
    $trail->push('Orders', route('home.orders'));
});

Breadcrumbs::for('home.orders.show', function ($trail, $id) {
    $trail->parent('home.orders');
    //$data = Order::findOrFail($id);
    $trail->push('View order #' . $id, route('home.orders.show', $id));
});

Breadcrumbs::for('home.info', function ($trail) {
    $trail->parent('home');
    $trail->push('Info', route('home.info'));
});

//ADMIN
Breadcrumbs::for('admin', function ($trail) {
    $trail->push('Admin', route('admin'));
});

//Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('admin');
    $trail->push('Categories', route('categories'));
});

Breadcrumbs::for('categories.create', function ($trail) {
    $trail->parent('categories');
    $trail->push('New category', route('categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail, $id) {
    $trail->parent('categories');
    $data = Category::findOrFail($id);
    $trail->push($data->title, route('categories.edit', $id));
});

//Products
Breadcrumbs::for('products', function ($trail) {
    $trail->parent('admin');
    $trail->push('Products', route('products'));
});

Breadcrumbs::for('products.create', function ($trail) {
    $trail->parent('products');
    $trail->push('New product', route('products.create'));
});

Breadcrumbs::for('products.edit', function ($trail, $id) {
    $trail->parent('products');
    $data = Product::findOrFail($id);
    $trail->push($data->title, route('products.edit', $id));
});

//Orders
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('admin');
    $trail->push('Orders', route('orders'));
});

Breadcrumbs::for('orders.show', function ($trail, $id) {
    $trail->parent('orders');
    //$data = Order::findOrFail($id);
    $trail->push('View order #' . $id, route('orders.show', $id));
});
