<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\UserGroup;

class CreateGroupController extends Controller
{
    
    // public function index()
    // {
    //     // ログインしているユーザーのIDを取得
    //     $userId = auth()->id();

    //     // ユーザーが所属しているグループを取得
    //     $groups = UserGroup::where('user_id', $userId)
    //                         ->with('group') // グループの詳細情報も取得
    //                         ->get()
    //                         ->pluck('group'); // groupの情報だけを抽出

    //     return view('admin.group_list', compact('groups'));
    // }

    public function index(Request $request)
    {
        $userId = auth()->id();
    
        // 「戻る先」をセッションに保存（個人カレンダーから来た場合）
        if ($request->has('back_to')) {
            session(['group_calendar_back_url' => $request->input('back_to')]);
        }
    
        $userGroups = UserGroup::where('user_id', $userId)
                                ->with('group')
                                ->get();
    
        return view('admin.group_list', compact('userGroups'));
    }
    

}
