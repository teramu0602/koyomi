<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        // グループを取得し、関連するユーザーをwithで取得
        $group = UserGroup::with('users')->findOrFail($groupId);

        return view('admin.edit_group', compact('group'));
    }
}
