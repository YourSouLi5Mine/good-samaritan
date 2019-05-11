<?php

use Phaza\LaravelPostgis\Geometries\Point;
use Windwalker\Crypt\Password;

$factory->defineAs('App\User', 'admin', function () {
    $password = new Password(Password::MD5, md5(env('APP_KEY')));
    $pass = $password->create(env('ADMIN_PASSWORD'));
    return [
        'username' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => $pass
    ];
});


$factory->defineAs('App\User', 'user', function () {
    $password = new Password(Password::MD5, md5(env('APP_KEY')));
    $pass = $password->create(env('USER_PASSWORD'));
    return [
        'username' => 'ysim',
        'email' => 'ysim@gmail.com',
        'password' => $pass
    ];
});

$factory->define('App\Group', function (Faker\Generator $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define('App\Post', function (Faker\Generator $faker) {
    $point = new Point($faker->latitude, $faker->longitude);
    return [
      'location' => \DB::raw("ST_GeomFromText('POINT($point)')"),
      'contain' => $faker->sentence
    ];
});

$factory->defineAs('App\Role', 'admin_role', function () {
    return [
        'name' => 'admin',
        //add proper description later on
        'description' => 'Administrator'
    ];
});

$factory->defineAs('App\Role', 'user_role', function () {
    return [
        'name' => 'user',
        //add proper description later on
        'description' => 'User'
    ];
});
