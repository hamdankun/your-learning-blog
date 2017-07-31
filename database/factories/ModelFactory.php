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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(10),
        'slug' => $faker->uuid
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->uuid
    ];
});

$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {
    return [
        'user_id' => App\Models\User::orderByRaw('RAND()')->first()->id,
        'title' => $faker->sentence(3),
        'content' => $faker->sentence(10),
        'category_id' => App\Models\Category::orderByRaw('RAND()')->first()->id,
        'label' => array(),
        'slug' => $faker->uuid
    ];
});