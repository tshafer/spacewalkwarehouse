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
$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->catchPhrase,
        'description' => $faker->paragraph,
        'enabled'     => true,
        'slug'        => $faker->slug,
        'season'      => $faker->randomElement(['dry', 'wet', 'both']),
    ];
});