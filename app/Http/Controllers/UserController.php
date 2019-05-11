<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Windwalker\Crypt\Password;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index() {
    return response()->json(User::all());
  }

  public function create(Request $request) {
    $this->validate($request, [
        'username' => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required',
    ]);

    $password = new Password(Password::MD5, md5(env('APP_KEY')));
    $pass = $password->create($request->password);

    $user = new User;

    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = $pass;

    $user->save();

    $user
      ->roles()
      ->attach(Role::where('name', 'user')->first());

    return response()->json($user);
  }

  public function show($id) {
    $user = User::find($id);

    return response()->json($user);
  }

  public function update($id, Request $request) {
    $this->validate($request, [
        'username' => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required',
    ]);

    $user = User::find($id);

    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = $request->input('password');

    $user->save();

    return response()->json($user);
  }

  public function delete($id) {
    $user = User::find($id);

    $user->delete();

    return response()->json('User deleted sucessfully');
  }

  public function jwt_decoded(Request $request) {
    //return response()->json($request->auth);
    $authorizeRole = $request->auth->authorizeRoles('admin');
    if ($authorizeRole) {
      return response()->json([
        'auth' => 'Authorized'
      ], 200);
    }
    return response()->json([
      'error' => 'Unauthorized action'
    ], 401);
  }
}
