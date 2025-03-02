@extends('layouts.admin_calender')
@section('title', 'グループリスト')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
</head>

@section('content')
<div class = "container">
<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
</div>

<p class = "purple">青</p>
@endsection