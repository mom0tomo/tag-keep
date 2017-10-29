<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'is_done' => mt_rand(0, 1),
    ];
});