<?php

$factory->define(App\ProductCategory::class, function (Faker\Generator $faker) {
    return [
        "category" => $faker->name,
    ];
});
