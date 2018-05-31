<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'isAdmin' => 0,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'image_small' => $faker->imageUrl(250, 250),
        'image_large' => $faker->imageUrl(600, 600),
        'price' => $faker->numberBetween(100, 10000),
        'description' => $faker->paragraph(2), //$faker->realText(200),
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->paragraph(2),
    ];
});
