@extends('layouts.admin_calender')
@section('title', 'common')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
</head>

<main>
<div class = "container">
<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
</div>
</main>

