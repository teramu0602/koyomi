@extends('layouts.admin_calender')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
</head>

@section('content')
<div class = "container">
<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
</div>
<h1>グループリスト</h1>
    <!-- グループ名をリスト表示 -->
    <ul>
        @foreach ($groups as $group)
            <li>{{ $group->group_name }}</li> <!-- group_nameを表示 -->
        @endforeach
    </ul>
<p class = "purple">青</p>
@endsection