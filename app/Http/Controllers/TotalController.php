<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Group;
use App\Post;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class TotalController extends Controller {
  public function totals(Request $request) {
    $users = User::all()->count();
    $groups = Group::all()->count();
    $posts= Post::all()->count();

    $users = $users - 1;

    return response()->json([
      'users' => $users,
      'groups' => $groups,
      'posts' => $posts,
    ], 200);
  }
}
