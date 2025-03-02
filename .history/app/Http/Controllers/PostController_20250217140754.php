<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // すべての投稿を取得
        return view('calendar.home.index', compact('posts'));
    }
}
