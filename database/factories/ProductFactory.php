<?php

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        "product_name" => $faker->name,
        "product_category_id" => factory('App\ProductCategory')->create(),
        "product_description" => $faker->name,
        "in_stock" => $faker->randomNumber(2),
    ];
});
