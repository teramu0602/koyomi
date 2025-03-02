<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // すべての投稿を取得
        return view('posts.index', compact('posts'));
    }
}
