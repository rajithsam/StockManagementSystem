<?php

$factory->define(App\ProductDelivery::class, function (Faker\Generator $faker) {
    return [
        "beleiver_id" => factory('App\Believer')->create(),
        "product_id" => factory('App\Product')->create(),
        "date" => $faker->date("d/m/Y", $max = 'now'),
        "quantity" => $faker->randomNumber(2),
    ];
});
