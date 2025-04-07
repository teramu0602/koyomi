@extends('layouts.admin_calender')

@section('title', 'グループ編集')

@section('content')

{{--$groupはuser_groupsテーブルに紐づいてるためgroupsに変更が必要 --}}
    <h1>{{ $group->group->group_name }}のメンバー
    <br>
    参加IDID{{ $group->group->join_id }}
    <br>
    {{$users = $group->users}} 
 
    </h1>
{{--他の参加ユーザーを取得できていない　　リレーションの見直し--}}
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


@endsection