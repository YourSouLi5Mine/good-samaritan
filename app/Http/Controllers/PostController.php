<?php

namespace App\Http\Controllers;

use App\Post;
use App\Group;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index(Request $request, $group_id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      return response()->json([
        'posts' => Group::find($group_id)->posts->where('group_id', $group_id)
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function create(Request $request, $group_id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      $post = new Post;

      if ($request->location) {
        $post->location = $request->location;
      }

      $post->contain  = $request->contain;
      $post->group_id = $group_id;
      $post->user_id  = $auth->id;

      $post->save();

      return response()->json([
        'post' => $post
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function update(Request $request, $post_id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      $post = Post::find($post_id);

      if ($request->location) {
        $post->location = $request->location;
      }

      $post->contain  = $request->contain;

      $post->save();

      return response()->json([
        'post' => $post
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function delete(Request $request, $post_id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      $post = Post::find($post_id);

      $post->delete();

      return response()->json([
        'post' => $post
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }
}
