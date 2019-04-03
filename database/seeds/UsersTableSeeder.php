<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  public function run()
  {
    $genres = factory(App\User::class, 10)->create();
    //DB::table('users')->insert([
        //'name' => Str::random(10),
        //'email' => Str::random(10).'@gmail.com',
        //'password' => bcrypt('secret'),
    //]);
  }
}
