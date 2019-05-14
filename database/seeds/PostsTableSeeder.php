<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run() {
      $post = factory('App\Post')->create();
    }
}
