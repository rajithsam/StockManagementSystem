<?php

$factory->define(App\ProductOrder::class, function (Faker\Generator $faker) {
    return [
        "product_id" => factory('App\Product')->create(),
        "quantity" => $faker->randomNumber(2),
        "order_date" => $faker->date("d/m/Y", $max = 'now'),
    ];
});
