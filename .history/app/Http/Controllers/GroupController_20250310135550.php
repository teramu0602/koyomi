<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        $group = Group::with('users')->findOrFail($groupId);
        return view('groups.edit', compact('group'));
    }
}
