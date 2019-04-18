<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    public function run() {
      factory(Post::class, 10)->create();
    }
}
