<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index() {
    return response()->json(Post::all());
  }

  public function create(Request $request) {
    $post = new Post;

    $post->location = $request->location;
    $post->contain= $request->contain;

    $post->save();

    return response()->json($post);
  }

  public function show($id) {
    $post = Post::find($id);

    return response()->json($post);
  }

  public function update($id, Request $request) {
    $post = Post::find($id);

    $post->location = $request->input('location');
    $post->contain= $request->input('contain');

    $post->save();

    return response()->json($post);
  }

  public function delete($id) {
    $post = Post::find($id);

    $post->delete();

    return response()->json('Post deleted sucessfully');
  }
}
