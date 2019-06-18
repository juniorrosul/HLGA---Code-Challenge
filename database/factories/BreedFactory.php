<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Breed;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Breed::class, function (Faker $faker) {
    return [
        'breed_id' => Str::random(4),
        'name' => $faker->name,
        'temperament' => $faker->text(60),
        'life_span' => $faker->numerify('## - ##'),
        'alt_names' => $faker->name,
        'wikipedia_url' => $faker->url,
        'origin' => $faker->country,
        'weight_imperial' => $faker->numerify('## - ##'),
        'experimental' => $faker->numberBetween(0, 1),
        'hairless' => $faker->numberBetween(0, 1),
        'natural' => $faker->numberBetween(0, 1),
        'rex' => $faker->numberBetween(0, 1),
        'suppressed_tail' => $faker->numberBetween(0, 1),
        'short_legs' => $faker->numberBetween(0, 1),
        'hypoallergenic' => $faker->numberBetween(0, 1),
        'adaptability' => $faker->numberBetween(1, 5),
        'affection_level' => $faker->numberBetween(1, 5),
        'country_code' => $faker->countryCode,
        'child_friendly' => $faker->numberBetween(1, 5),
        'dog_friendly' => $faker->numberBetween(1, 5),
        'energy_level' => $faker->numberBetween(1, 5),
        'grooming' => $faker->numberBetween(1, 5),
        'health_issues' => $faker->numberBetween(1, 5),
        'intelligence' => $faker->numberBetween(1, 5),
        'shedding_level' => $faker->numberBetween(1, 5),
        'social_needs' => $faker->numberBetween(1, 5),
        'stranger_friendly' => $faker->numberBetween(1, 5),
        'vocalisation' => $faker->numberBetween(1, 5),
    ];
});
