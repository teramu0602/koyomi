<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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


    public function index()
    {
        // 最新の投稿データを1件取得
        $post = Post::latest()->first(); // もしくは、必要な条件でデータを取得
    
        // ビューにデータを渡す
        return view('calender.home', compact('post'));
    }


    public function store(Request $request)
    {
        dd($request->method());
        $request->validate([
            'group_name' => 'required|string|max:255',
            'join_id' => 'required|integer|exists:users,id',
            'edit_flg' => 'nullable|boolean'
        ]);

        Group::create([
            'group_name' => $request->group_name,
            'join_id' => $request->join_id,
            'edit_flg' => $request->has('edit_flg') ? 1 : 0
        ]);

        return redirect()->with('success', 'グループを作成しました！');
    }




}
