<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        $group = UserGroup::with(['group'])->findOrFail($groupId);
        return view('admin.edit_group', compact('group'));
    }
}
