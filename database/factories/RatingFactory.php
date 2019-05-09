<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Rating::class, function (Faker $faker) {
    return [
        'rating'=>rand(1,10)
    ];
});
