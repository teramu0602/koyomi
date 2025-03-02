<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;

class CalendarController extends Controller
{
    public function show($year, $month)
    {
        return view('calender.home', compact('year', 'month'));
    }

    public function showAdmin($year, $month)
    {
        return view('calender.home', compact('year', 'month'));
    }

//お試しコード
    public function index()
    {
        // 最新の投稿データを1件取得
        $post = Post::latest()->first(); // もしくは、必要な条件でデータを取得
    
        // ビューにデータを渡す
        return view('calender.home', compact('post'));
    }

//グループ作成データの保存

$group = Group::create([
    'group_name' => $request->group_name,
    'edit_flg' => $request->has('edit_flg') ? 1 : 0,  // チェックボックスがオンの場合は1、それ以外は0
]);

// グループ作成後に、user_groupsテーブルに参加者情報を保存
$owner_id = auth()->id();  // ログインユーザーのID（オーナーID）

\Log::info("Group created with ID: " . $group->id);

// 参加者情報（user_groupsテーブル）
UserGroup::create([
    'user_id' => $request->join_id,  // 参加するユーザーID
    'group_id' => $group->id,  // 作成したグループID
    'owner_id' => $owner_id,  // グループのオーナーID
    'edit_flg' => $request->has('edit_flg') ? 1 : 0,  // 編集権限
]);

return redirect()->back()->with('success', 'グループを作成しました！');
}



}
