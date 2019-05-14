<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  public function run() {
    $admin_role = factory('App\Role', 'admin_role')->create();
    $user_role  = factory('App\Role', 'user_role')->create();

    $admin_user = factory('App\User', 'admin')->create();
    $admin_user->roles()->save($admin_role);
    $admin_user->roles()->save($user_role);

    $user = factory('App\User', 'ysim')->create();
    $user->roles()->save($user_role);

    $tango = factory('App\User', 'tango')->create();
    $tango->roles()->save($user_role);
  }
}
