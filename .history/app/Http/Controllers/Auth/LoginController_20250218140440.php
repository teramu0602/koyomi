<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        // バリデーション
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // ユーザー名とパスワードで認証
        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            // 認証成功後、リダイレクト
            return redirect()->intended('/dashboard');
        }

        // 認証失敗
        return back()->withErrors(['username' => 'ユーザー名またはパスワードが間違っています。']);
    }
}