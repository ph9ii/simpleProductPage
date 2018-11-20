<?php

use App\User;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Product::truncate();

        $usersQuantity = 100;
        $productsQuantity = 100;

        factory(User::class, $usersQuantity)->create();
        factory(Product::class, $productsQuantity)->create();
    }
}
