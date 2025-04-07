@extends('layouts.admin_calender')

@section('title', 'グループ編集')

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
<h1>グループ情報の編集</h1>
<p>グループ名：{{ $group->group_name }}</p>
<form action="{{ route('groups.update', ['group' => $group->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="group_name">グループ名：</label>
    <input type="text" id="group_name" name="group_name" value="{{ $group->group_name }}" required>

    <label for="edit_flg">編集・削除機能：</label>
    <select id="edit_flg" name="edit_flg">
        <option value="1" {{ $group->edit_flg == 1 ? 'selected' : '' }}>有効</option>
        <option value="0" {{ $group->edit_flg == 0 ? 'selected' : '' }}>無効</option>
    </select>

    <button type="submit">更新</button>  <!-- 更新ボタン -->
</form>

<!-- 削除ボタンは form の外に配置する -->
<h2>メンバー一覧</h2>
<ul>
    @foreach ($group->users as $user)
    <li>
        {{ $user->name }} (ID: {{ $user->id }})
        @if($is_owner && $user->id !== auth()->id())
        <form action="{{ route('groups.removeUser', ['group' => $group->id, 'user' => $user->id]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('このユーザーを削除しますか？');">削除</button>
        </form>
        @endif
    </li>
    @endforeach
</ul>

@else
<h1>グループ情報</h1>

<p>グループ名：{{ $group->group_name }}</p>

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






<!-- <form action="{{ route('groups.update', ['group' => $group->id]) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="group_name">グループ名：</label>
    <input type="text" id="group_name" name="group_name" value="{{ $group->group_name }}" required>
    
    <button type="submit">更新</button>
</form> -->



@endsection