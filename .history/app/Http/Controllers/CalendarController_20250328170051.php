<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Models\UserGroup; 

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
    public function store(Request $request)
    {

        //デバッグ
        \Log::info($request->all());


        $request->validate([
            'group_name' => 'required|string|max:30',
            'join_id' => 'required|integer|max:5',
            'edit_flg' => 'nullable|boolean'
        ], [
            'group_name.max' => 'グループ名は30文字以内で入力してください。',
            'join_id.max' => '参加IDは30文字以内で入力してください。',
        ]);

        // デバッグ用に確認
\Log::info("Validated data: ", $request->only(['group_name', 'join_id', 'edit_flg']));

$group = Group::create([
    'group_name' => $request->group_name,
    'join_id' => $request->join_id,  // 入力されたjoin_idを保存
    'edit_flg' => $request->has('edit_flg') ? 1 : 0,  // チェックボックスがある場合のみ1
]);

// グループ作成者（ログイン中のユーザー）をオーナーとして設定
if ($group) {
    // グループ作成者（ログイン中のユーザー）をオーナーとして設定
    UserGroup::create([
        'user_id' => auth()->id(),  // ログインしているユーザーのID
        'group_id' => $group->id,   // 作成したグループのID
        'owner_flg' => 1,           // オーナーフラグを1に設定（オーナーとして扱う）
    ]);

return redirect()->route('groups.list')->with('success', 'グループが作成されました！');
    }


    return back()->with('error', 'グループ作成に失敗しました。');
}


}
