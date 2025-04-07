@extends('layouts.admin_calender')
@section('title', 'グループリスト')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">

</head>

@section('content')
<h1>グループリスト</h1>
<form action="{{ route('grouplist') }}" method="GET" style="display: inline;">
<button class = "btn"  onclick="toggleMode()">参加</button>
</form>
<form action="{{ route('grouplist') }}" method="GET" style="display: inline;">
<button class = "btn" onclick="toggleMode()">作成</button>
</form>
</div>
    <!-- データがある場合はリスト表示、ない場合はメッセージ表示 -->
    @if ($groups->isEmpty())
        <p>まだグループがありません。</p>
    @else
        <ul>
            @foreach ($groups as $group)
                <li>{{ $group->group_name }}</li> <!-- group_nameを表示 -->
                <button class = "btn1" onclick="toggleMode()">グループ / 個人</button>
            @endforeach
        </ul>
    @endif

    <p class = "purple">紫</p>

@endsection