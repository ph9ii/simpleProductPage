<?php
use App\User;
use App\Product;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    
    $quantity = $faker->randomNumber(2);
    $price = $faker->randomNumber(3);

    return [
        'title' => $faker->name,
        'seller_id' => User::all()->random()->id,
        'slug' => str_slug($faker->name),
        'quantity' => $quantity,
        'price' => $price ,
        'total' => $quantity * $price
    ];
});
