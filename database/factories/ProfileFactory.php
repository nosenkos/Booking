<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'firstname'=>$faker->firstName,
        'lastname'=>$faker->lastName,
        'gender'=>$faker->randomElement(['male','female','unknown']),
        'address'=>$faker->address,
        'phone'=>$faker->phoneNumber,
        'country_id'=>rand(1,100),
        'state_id'=>rand(1,500),
        'city_id'=>rand(1,1000),
    ];
});
