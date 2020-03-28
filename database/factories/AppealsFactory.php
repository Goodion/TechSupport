<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appeal;
use Faker\Generator as Faker;

$factory->define(Appeal::class, function (Faker $faker) {
    return [
        'title' => $faker->words(5, true),
        'body' => $faker->sentences(6, true),
        'closed' => $faker->boolean,
        'viewed' => $faker->boolean,
        'file' => null,
        'author_id' => factory(User::class),
    ];
});
