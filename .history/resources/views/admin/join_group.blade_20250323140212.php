@extends('layouts.admin_calender')
@section('title','グループ参加')
@section('content')
<h1 class="h1">グループに参加</h1>
<div class="button-container">
<form action="{{ route('join.store') }}" method="POST">
    @csrf
    <div>
        <label for="group_name">グループ名</label>
        <input type="text" id="group_name" name="group_name" required>
    </div>

    <div>
        <label for="join_id">参加パスワード</label>
        <input type="number" id="join_id" name="join_id" required>
    </div>


    <button type="submit">参加する</button>
    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
    @endif
</form>
</div>
@endsection