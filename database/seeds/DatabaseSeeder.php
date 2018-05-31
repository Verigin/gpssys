<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'isAdmin' => 1,
            'password' => bcrypt('admin'),
        ]);

        factory(App\Category::class, 5)->create()->each(function ($c) {
            $c->products()->saveMany(factory(App\Product::class, 10)->make());
        });

        // factory(App\Product::class, 10)->create();
        // factory(App\User::class, 2)->create();

    }
}
