<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
  public function index(Request $request) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      return response()->json([
        'groups' => Group::all() 
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function create(Request $request) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      $group = new Group;

      $group->name = $request->name;

      $group->save();

      $group
        ->users()
        ->attach($auth, ['owner' => true]);

      return response()->json([
        'group' => $group
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
    return response()->json($group);
  }

  public function show(Request $request, $id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      foreach ($auth->groups as $group) {
        if ($group->id == $id) {
          return response()->json([
            'group' => $group
          ], 200);
        }
      }

      return response()->json([
        'error' => "User don't belong to that group"
      ], 401);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function update(Request $request, $id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      foreach ($auth->groups as $group) {
        if (($group->pivot->owner) && ($group->id == $id)) {
          $group->name = $request->input('name');

          $group->save();

          return response()->json([
            'group' => $group
          ], 200);
        }
      }
      return response()->json([
        'error' => 'Group not found or not owner'
      ]);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function delete_my_group(Request $request, $id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('user')) {
      foreach ($auth->groups as $group) {
        if (($group->pivot->owner) && ($group->id == $id)) {
          $group
              ->users()
              ->detach();

          $group->delete();

          return response()->json([
            'group' => $group
          ], 200);
        }
      }
      return response()->json([
        'error' => 'Group not found or not owner'
      ]);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }

  public function delete_group(Request $request, $id) {
    $auth = $request->auth;
    if ($auth == null) {
      return response()->json([
        'error' => "The token provided doesn't belong to any user"
      ]);
    } elseif ($auth->authorizeRoles('admin')) {
      $group = Group::find($id);

      if ($group == null) {
        return response()->json([
          'error' => "Group doesn't exist"
        ], 401);
      }

      $group
        ->users()
        ->detach();

      $group->delete();

      return response()->json([
        'group' => $group
      ], 200);
    } else {
      return response()->json([
        'error' => 'Unauthorized action'
      ], 401);
    }
  }
}
