<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    public function run() {
      factory(Group::class, 10)->create();
    }
}
