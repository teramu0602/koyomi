@extends('layouts.admin')

@section('title', 'login')

@section('content')
        <h2 class="col-md ">ログイン</h2>
        <form action="#" method="POST">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="username" placeholder="ユーザー名">

            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" placeholder="パスワード">

            <div class="checkbox">
    <input type="checkbox" name="remember" id="remember">
    <div class="remember">
        <label for="remember">ログインしたままにする</label>
    </div>
</div>

        <p class="login-link">
        <a href="/signup">アカウント作成はこちら</a>
        </p>
@endsection