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
        'content' => $faker->sentence(500),
        'category_id' => App\Models\Category::orderByRaw('RAND()')->first()->id,
        'description' => $faker->sentence(15),
        'label' => array(),
        'slug' => $faker->uuid,
        'image' => $faker->image(storage_path('app/public/article-images/640x480'), 640, 480)
    ];
});

$factory->define(App\Models\Visitor::class, function (Faker\Generator $faker) {
    return [
       'article_id' => App\Models\Article::whereNotIn('id', App\Models\Visitor::pluck('article_id')->toArray())->first()->id,
       'total' => $faker->randomNumber
   ];
});

$factory->define(App\Models\VisitorPerDay::class, function (Faker\Generator $faker) {
    return [
        'visitor_id' => App\Models\Visitor::orderByRaw('RAND()')->first()->id,
        'total' => $faker->randomNumber
    ];
});

$factory->define(App\Models\VisitorDetail::class, function (Faker\Generator $faker) {
    return [
        'visitor_per_day_id' => App\Models\VisitorPerDay::orderByRaw('RAND()')->first()->id,
        'ip_address' => $faker->ipv4,
        'page' => App\Models\Article::orderByRaw('RAND()')->first()->slug,
        'browser' => 'chrome'
    ];
});
