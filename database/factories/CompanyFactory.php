<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->company(),
        'email' => $faker->companyEmail(),
        'logo' => $faker->imageUrl($width = 640, $height = 480),
        'description' => $faker->text($maxNbChars = 200),
        'url' => $faker->url(),
        
    ];
});
