<?php

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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function ($faker) {
    return [
        'provider' => $faker->randomElement(['facebook', 'twitter', 'google', 'weblink']),
        'provider_id' => str_random(32),
        'text' => str_random(100),
        
        'image' => $faker->optional()->imageUrl,
        'link' => $faker->optional()->url,
        'user_id' => $faker->randomNumber,
        'posted_at' => $faker->unixTime,
        'created_at' => $faker->unixTime,
        'updated_at' => $faker->unixTime,
    ];
});
