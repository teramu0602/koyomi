<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // すべての投稿を取得
        return view('calender.home', compact('posts'));

        public function index()
        {
            // 最新の投稿データを1件取得
            $post = Post::latest()->first(); // もしくは、必要な条件でデータを取得
        
            // ビューにデータを渡す
            return view('calender.home', compact('post'));
    }
}
