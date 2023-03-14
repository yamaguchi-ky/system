<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\testUsers;
use Faker\Generator as Faker;

$factory->define(testUsers::class, function (Faker $faker) {
    return [
        'company_id'=>$faker->year(),
        'product_name'=>$faker->company(),
        'price'=>$faker->dayOfMonth(),
        'stock'=>$faker->month(),
        'comment'=>$faker->city(),
        'img_path'=>$faker->city()
    ];
});
