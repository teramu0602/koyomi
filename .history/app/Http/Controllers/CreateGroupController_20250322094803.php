<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\UserGroup;

class CreateGroupController extends Controller
{
    
    public function index()
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->id();

        // ユーザーが所属しているグループを取得
        $groups = UserGroup::where('user_id', $userId)
                            ->with('group') // グループの詳細情報も取得
                            ->get()
                            ->pluck('group'); // groupの情報だけを抽出

        return view('admin.group_list', compact('groups'));
    }
    
    public function leaveGroup($groupId)
    {
        // ログインしているユーザーのIDを取得
        $userId = auth()->id();
    
        // グループに所属しているか確認
        $userGroup = UserGroup::where('user_id', $userId)->where('group_id', $groupId)->first();
    
        if (!$userGroup) {
            return redirect()->back()->with('error', 'グループに参加していません。');
        }
    
        // グループから退会
        $userGroup->delete();
    
        return redirect()->route('groups.list')->with('success', 'グループから退会しました。');
    }

}
