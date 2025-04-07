<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        //$group = UserGroup::with(['users', 'group', 'user_groups'])->findOrFail($groupId);
            
        $group = Group::with(['users'])
            ->where('id', $groupId)
            ->firstOrFail();
        
        return view('admin.edit_group', compact('group'));
    }
}
