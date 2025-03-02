@extends('layouts.admin')

@section('title', 'ログイン')

@section('content')
    <h2>ログイン</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}" required autofocus>

        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" placeholder="パスワード" required>

        <div class="checkbox">
            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">ログインしたままにする</label>
        </div>

        <button type="submit">ログイン</button>
    </form>


    <p class="login-link">
        <a href="{{ route('admin/signup') }}">アカウントをお持ちでない方はこちら</a>
    </p>
@endsection
