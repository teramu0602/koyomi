<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateGroupController extends Controller
{
    //
    public function index()
{
    // 最新の投稿データを1件取得
    $post = Post::latest()->first(); // もしくは、必要な条件でデータを取得
    
    // グループのデータを取得（例: Groupモデルを使ってデータを取得）
    $groups = Group::all();  // 例: 全てのグループを取得
    
    // ビューにデータを渡す
    return view('calender.home', compact('post', 'groups'));
}
}
