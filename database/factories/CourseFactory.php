<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
  return [
    'name' => $faker->name,
    'slug' => $faker->slug,
    'details' => $faker->text,
    'price' => rand(149999, 249999),
    'description' => $faker->realText($faker->numberBetween(10, 20))
  ];
});
