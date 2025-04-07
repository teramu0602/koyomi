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
        $user_group = UserGroup::where('user_id', $userId)->where('group_id', $groupId)->firstOrFail();
        $is_owner = $user_group->owner_flg == 1;

        return view('admin.edit_group', compact('group', 'is_owner'));
    }

    public function update(Request $request, $groupId)
{
    $request->validate([
        'group_name' => 'required|string|max:255',
        'edit_flg' => 'required|boolean',
    ]);

    $group = Group::findOrFail($groupId);

    // オーナーのみ変更可能
    $userId = auth()->id();
    $user_group = UserGroup::where('user_id', $userId)->where('group_id', $groupId)->first();

    if (!$user_group || $user_group->owner_flg !== 1) {
        return redirect()->back()->with('error', 'グループ名を変更する権限がありません。');
    }

    $group->group_name = $request->input('group_name');
    $group->save();

    return redirect()->back()->with('success', 'グループ名を更新しました。');
}



}
