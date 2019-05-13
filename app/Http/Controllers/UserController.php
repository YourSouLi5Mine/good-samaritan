<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Windwalker\Crypt\Password;
use Illuminate\Http\Request;

class UserController extends Controller {
  public function index(Request $request) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      return response()->json([
        'users' => User::all() 
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
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

  public function show(Request $request, $id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      return response()->json([
        'user' => User::find($id)
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function update(Request $request) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      $this->validate($request, [
          'username' => 'required',
          'email'    => 'required|email|unique:users',
          'password' => 'required',
      ]);

      $password = new Password(Password::MD5, md5(env('APP_KEY')));
      $pass = $password->create($request->password);

      $user = User::find($request->auth->id);

      $user->username = $request->username;
      $user->email = $request->email;
      $user->password = $pass;

      $user->save();

      return response()->json([
        'user' => $user
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function delete_myself(Request $request) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      $user = User::find($request->auth->id);

      $user->delete();

      return response()->json([
        'user' => $user
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function delete_other(Request $request, $id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('admin')) {
      $user = User::find($id);

      $user->delete();

      return response()->json([
        'user' => $user
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }
}
