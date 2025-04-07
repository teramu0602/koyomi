<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        $group = UserGroup::with(['users', 'group', 'user_groups'])->findOrFail($groupId);
            
        $group = UserGroup::with(['users', 'group'])
            ->where('group_id', $groupId)
            ->firstOrFail();
        return view('admin.edit_group', compact('group'));
    }
}
