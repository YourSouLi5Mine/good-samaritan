<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    public function run() {
      $group = factory('App\Group')->create();
      $group->users()->attach(2, ['owner' => true]);
    }
}
