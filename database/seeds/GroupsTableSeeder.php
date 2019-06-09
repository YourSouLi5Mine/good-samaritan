<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    public function run() {
      $first_group = factory('App\Group')->create();
      $first_group->users()->attach(2, ['owner' => true]);
      $first_group->users()->attach(3, ['owner' => false]);
      $first_group->users()->attach(4, ['owner' => false]);

      $second_group = factory('App\Group')->create();
      $second_group->users()->attach(2, ['owner' => true]);
      $second_group->users()->attach(4, ['owner' => false]);

      $third_group = factory('App\Group')->create();
      $third_group->users()->attach(3, ['owner' => true]);
      $third_group->users()->attach(4, ['owner' => false]);
    }
}
