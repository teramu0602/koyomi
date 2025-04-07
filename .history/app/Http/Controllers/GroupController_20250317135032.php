<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        $group = UserGroup::with('users')->findOrFail($groupId);
        $users;
        return view('admin.edit_group', compact('group'));
    }
}
