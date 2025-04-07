<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\UserGroup; 

class JoinController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'group_name' => 'required|string',
        'join_id' => 'required|integer',
    ]);

    $group = Group::where('group_name', $request->group_name)
                  ->where('join_id', $request->join_id)
                  ->first();

    if (!$group) {
        return redirect()->back()->with('error', 'グループが見つかりません。');
    }

    $userGroup = UserGroup::create([
        'user_id' => auth()->id(),
        'group_id' => $group->id,
        'owner_flg' => 0,
    ]);

    return redirect()->route('groups.list')->with('success', 'グループに参加しました！');
}
}
