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

$factory->define(App\Libro::class, function (Faker\Generator $faker) {
    return [
        'titulo' => $faker->sentence(3,true),
        'descripcion' => $faker->sentence(3,true),
        'precio' => $faker->numberBetween(25,125),
        'autor_id' => $faker->numberBetween(1,50)
    ];
});
