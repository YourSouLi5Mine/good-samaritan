<?php

use Phaza\LaravelPostgis\Geometries\Point;


$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => $faker->password
    ];
});

$factory->define(App\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $point = new Point($faker->latitude, $faker->longitude);
    return [
      'location' => \DB::raw("ST_GeomFromText('POINT($point)')"),
      'contain' => $faker->sentence
    ];
});
