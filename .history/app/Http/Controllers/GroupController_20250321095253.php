<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\UserGroup;

class GroupController extends Controller
{
    public function edit($groupId)
    {
        //$group = UserGroup::with(['users', 'group', 'user_groups'])->findOrFail($groupId);
            
        $group = Group::with(['users'])
            ->where('id', $groupId)
            ->firstOrFail();

        // ログインしているユーザーのIDを取得
        $userId = auth()->id();
        $user_group = UserGroup::where('user_id', $userId)->get();
        $is_owner = $user_group->owner_flg == 1;

        return view('admin.edit_group', compact('group', 'is_owner'));
    }
}
