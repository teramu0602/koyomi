@extends('layouts.admin')

@section('title', 'sign up')

@section('content')
        <h2>アカウントの作成</h2>
        <form action="#" method="POST">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="username" placeholder="ユーザー名">

            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="パスワード">

            <label for="confirm">確認</label>
            <input type="password" id="confirm" name="confirm" placeholder="確認">

            <button type="submit">アカウントを作成する</button>
        </form>

        <p class="login-link">
        <a href="/custom-login">アカウントをお持ちの方はこちら</a>
        </p>
@endsection