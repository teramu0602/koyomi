@extends('admin.calendar_common')
@section('title', 'グループリスト')
@section('css')
<link href="{{ asset('css/common.header.css') }}" rel="stylesheet">
@endsection
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">






</head>

@section('content')
<h1>グループリスト</h1>
<div class="btn-container">
    <div class = "ctn">
<form action="{{ route('grouplist') }}" method="GET" style="display: inline;">
<button class = "btn"  onclick="toggleMode()">参加</button>
</form>
<form action="{{ route('groupcreate') }}" method="GET" style="display: inline;">
<button class = "btn" onclick="toggleMode()">作成</button>
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
                <span class="group-name">{{ $group->group_name }}</span> <!-- group_nameを表示 -->
                <div class="button-container">
                    <button class="btn1" onclick="toggleMode()">編集</button>
                    <button class="btn1" onclick="toggleMode()">退会</button>
                </div>
            </li>
        @endforeach
    </ul>
@endif



@endsection