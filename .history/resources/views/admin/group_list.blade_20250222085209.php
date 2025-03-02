@extends('layouts.admin_calender')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
</head>

@section('content')
<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
@endsection