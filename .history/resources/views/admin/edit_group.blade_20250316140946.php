@extends('layouts.admin_calender')

@section('title', 'グループ編集')

@section('content')
    <h1>{{ $group->group_name }} のメンバー</h1>

    <h2>メンバー一覧</h2>
    <ul>
        @if ($group->users->isNotEmpty()) {{-- ユーザーがいるか確認 --}}
            @foreach ($group->users as $user)
                @if (is_object($user)) {{-- 確実にオブジェクトであることを確認 --}}
                    <li>{{ $user->name }} (ID: {{ $user->id }})</li>
                @else
                    <li>データの取得に問題があります。</li>
                @endif
            @endforeach
        @else
            <li>メンバーがいません。</li>
        @endif
    </ul>

    {{-- デバッグ用 --}}
    <h2>デバッグ情報</h2>
    <pre>{{ json_encode($group, JSON_PRETTY_PRINT) }}</pre>
@endsection