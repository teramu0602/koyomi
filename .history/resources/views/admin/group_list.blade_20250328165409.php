@extends('layouts.admin_calender')
@section('title', 'グループリスト')
@section('css')
<link href="{{ asset('css/common.header.css') }}" rel="stylesheet">
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
@endsection


@section('content')
<h1 class="h1">グループリスト</h1>
<div class="btn-container">
    <div class="ctn">
        <form action="{{ route('groupjoin') }}" method="GET" style="display: inline;">
            <button class="btn" onclick="toggleMode()">参加</button>
        </form>
        <form action="{{ route('groupcreate') }}" method="GET" style="display: inline;">
            <button class="btn" onclick="toggleMode()">作成</button>
        </form>
    </div>
</div>
<!-- データがある場合はリスト表示、ない場合はメッセージ表示 -->
@if ($groups->isEmpty())
<p>まだグループがありません。</p>
@else
<ul class="list-container">
    @foreach ($groups as $group)
    <li>
        <span class="group-name">
        <a class="none" href="{{ route('group.home', ['id' => $group->id]) }}">{{ $group->group_name }}</a>
        
        </span>
        <div class="button-container">
            <form action="{{ route('groups.edit', $group->id) }}" method="GET" style="display:inline;">
                <button type="submit" class="btn">詳細</button>
            </form>
            <form action="{{ route('groups.leave', $group->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn1" onclick="return confirm('本当に退会しますか？');">退会</button>
</form>

        </div>
    </li>
    @endforeach
    <p class="plist">※自身で作成したグループのみ詳細からグループ設定を変更することが出来ます。</p>
</ul>
@endif
@error('edit_flg')
            <p style="color: red;">{{ $message }}</p>
        @enderror
@endsection