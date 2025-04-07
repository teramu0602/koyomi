@extends('layouts.admin_calender')

@section('title', 'グループ編集')

@section('content')

{{--$groupはuser_groupsテーブルに紐づいてるためgroupsに変更が必要
    user_groups でのidが前ページから渡されているので、group_idが渡るように変更が必要 --}}
    <h1>{{ $group->group_name }}のメンバー
    <br>
    参加ID：{{ $group->join_id }}
    <br>
    グループID：{{ $group->id }}
    <br>
    @if ($group->edit_flg == 1)
        <p>編集・削除機能：有効</p>
    @else
        <p>編集・削除機能：無効</p>
    @endif
    <p>参加人数: {{ count($group->users) }} 人</p>
    <br>
aaaaaaaaa    {{ $is_owner }}
 
    </h1>

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