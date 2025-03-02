@extends('layouts.admin_calender')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
</head>

@section('content')
<div class = "container">
<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
</div>
<h1>グループリスト</h1>
<p class = "purple">青</p>
@endsection