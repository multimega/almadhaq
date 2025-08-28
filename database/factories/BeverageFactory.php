<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\beverage;
use Faker\Generator as Faker;

$factory->define(beverage::class, function (Faker $faker) {
    return [
       'name' => $faker->wrok,
    ];
});
