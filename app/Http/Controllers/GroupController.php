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
      $group = Group::find($id);

      if ($group == null) {
        return response()->json([
          'error' => "Group doesn't exist"
        ], 401);
      }

      return response()->json([
        'group' => $group
      ], 200);
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
      if (sizeOf($auth->groups) == 0) {
        return response()->json([
          'error' => 'You have not created or joined any groups yet'
        ]);
      } elseif (sizeOf($auth->groups) == 1) {
        if (($auth->groups[0]->pivot->owner == true) && ($auth->groups[0]->pivot->group_id == $id)) {
          $updated_group = Group::find($id);

          $updated_group->name = $request->input('name');

          $updated_group->save();

          return response()->json([
            'group' => $updated_group
          ], 200);
        }
      } else if (sizeOf($auth->groups) > 1) {
        foreach ($auth->groups as $group) {
          if (($group->pivot->owner == true) && ($group->pivot->group_id == $id)) {
            $updated_group = Group::find($id);

            $updated_group->name = $request->input('name');

            $updated_group->save();

            return response()->json([
              'group' => $updated_group
            ], 200);
          }
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
      if (sizeOf($auth->groups) == 0) {
        return response()->json([
          'error' => 'You have not created or joined any groups yet'
        ]);
      } elseif (sizeOf($auth->groups) == 1) {
        if (($auth->groups[0]->pivot->owner == true) && ($auth->groups[0]->pivot->group_id == $id))
        {
          $group = Group::find($id);

          $group
              ->users()
              ->detach($auth);

          $group->delete();

          return response()->json([
            'group' => $group
          ], 200);
        }
      } else if (sizeOf($auth->groups) > 1) {
        foreach ($auth->groups as $group) {
          if (($group->pivot->owner == true) && ($group->pivot->group_id == $id)) {
            $group = Group::find($id);

            $group
              ->users()
              ->detach($auth);

            $group->delete();

            return response()->json([
              'group' => $group
            ], 200);
          }
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

      foreach ($group->users as $user) {
        $group
          ->users()
          ->detach($user);
      }

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
