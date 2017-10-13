<?php

$factory->define(App\Believer::class, function (Faker\Generator $faker) {
    return [
        "first_name" => $faker->name,
        "last_name" => $faker->name,
        "address" => $faker->name,
        "phone_number" => $faker->randomNumber(2),
        "email" => $faker->safeEmail,
        "date_of_birth" => $faker->date("d/m/Y", $max = 'now'),
    ];
});
