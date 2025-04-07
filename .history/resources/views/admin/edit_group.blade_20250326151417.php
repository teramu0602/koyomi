@extends('layouts.admin_calender')

@section('title', 'グループ編集')
@section('css')
<link href="{{ asset('css/common.header.css') }}" rel="stylesheet">
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
@endsection
@section('content')

<!-- <br>
    {{ $group->group_name }}のメンバー
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
    <br> -->

@if($is_owner)
<h1 class="h1">グループ情報の編集</h1>
<p>グループ名：{{ $group->group_name }}</p>
<form action="{{ route('groups.update', ['group' => $group->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" id="group_name" name="group_name" value="{{ $group->group_name }}" required>

    @if ($group->edit_flg == 1)
    <p>編集・削除機能：有効</p>
    @else
    <p>編集・削除機能：無効</p>
    @endif
    <label for="edit_flg">編集・削除機能：</label>
    <select id="edit_flg" name="edit_flg">
        <option value="1" {{ $group->edit_flg == 1 ? 'selected' : '' }}>有効</option>
        <option value="0" {{ $group->edit_flg == 0 ? 'selected' : '' }}>無効</option>
    </select>
    <!-- 変更するとメッセージが出る -->
    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
    @endif
    <button type="submit">更新</button>
</form>
    <p>参加者：{{ count($group->users) }} 人</p>
    <ul class="list-container">
        @if ($group->users->isNotEmpty())
        @foreach ($group->users as $user)
        <li>
            {{ $user->name }} 
            @if($is_owner && $user->id !== auth()->id()) {{-- オーナーのみ削除可能、自分は削除できない --}}
            <form action="{{ route('groups.removeUser', ['group' => $group->id, 'user' => $user->id]) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('このユーザーを削除しますか？');">削除</button>
            </form>
            @endif
        </li>
        @endforeach
        @else
        <li>メンバーがいません。</li>
        @endif
    </ul>


@else
<h1>グループ情報</h1>

<p>グループ名：{{ $group->group_name }}</p>

@if ($group->edit_flg == 1)
    <p>編集・削除機能：有効</p>
    @else
    <p>編集・削除機能：無効</p>
@endif

<p>参加者：{{ count($group->users) }} 人</p>
<ul>
    @if ($group->users->isNotEmpty()) {{-- ユーザーがいるか確認 --}}

        @foreach ($group->users as $user)
        @if (is_object($user)) {{-- 確実にオブジェクトであることを確認 --}}
            <li>{{ $user->name }}</li>
            @else
            <li>データの取得に問題があります。</li>
        @endif
        @endforeach
        @else
        <li>メンバーがいません。</li>
    @endif
</ul>
@endif

@endsection