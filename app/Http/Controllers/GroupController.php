<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
  public function index() {
    return response()->json(Group::all());
  }

  public function create(Request $request) {
    $group = new Group;

    $group->name = $request->name;

    $group->save();

    return response()->json($group);
  }

  public function show($id) {
    $group = Group::find($id);

    return response()->json($group);
  }

  public function update($id, Request $request) {
    $group = Group::find($id);

    $group->name = $request->input('name');

    $group->save();

    return response()->json($group);
  }

  public function delete($id) {
    $group = Group::find($id);

    $group->delete();

    return response()->json('Group deleted sucessfully');
  }
}
