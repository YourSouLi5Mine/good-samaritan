<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index() {
    return response()->json(User::all());
  }

  public function create(Request $request) {
    $user = new User;

    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = $request->password;

    $user->save();

    return response()->json($user);
  }

  public function show($id) {
    $user = User::find($id);

    return response()->json($user);
  }

  public function update($id) {
    $user = User::find($id);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = $request->input('password');

    $user->save();

    return response()->json($user);
  }

  public function destroy($id) {
    $user = User::find($id);

    $user->destroy();

    return response()->json('User deleted sucessfully');
  }
}
