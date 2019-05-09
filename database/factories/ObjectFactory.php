<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\PropertyObject::class, function (Faker $faker) {
    return [
        'title'=>$faker->company,
        'description'=>$faker->realText(2500),
        'price_per_day'=>$faker->randomFloat(2,10, 5000),
        'country_id'=> rand(1,100),
        'state_id'=> rand(1,500),
        'city_id'=> rand(1,1000),
        'lat'=>$faker->latitude,
        'lon'=>$faker->longitude
    ];
});
