<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        $group = UserGroup::with('user_id')->findOrFail($groupId);
        return view('edit_groups', compact('group'));
    }
}
