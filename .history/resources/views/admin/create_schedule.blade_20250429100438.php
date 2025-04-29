@extends('layouts.admin_calender')
@section('title', 'スケジュール作成')
@section('content')
<div class="w600">
    <h1>スケジュールを作成</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('schedule.store') }}" method="POST">
        @csrf

        <label>日付</label>
        <input type="date" name="start_date" required>
        ～
        <input type="date" name="end_date" required>

        <label>時間</label>
        <input type="time" name="start_time">
        ～
        <input type="time" name="end_time">

        <label>タイトル</label>
        <input type="text" name="title" required>

        <label>内容</label>

        <textarea name="content" class="form-control textarea"></textarea>

        <button type="submit">作成する</button>
    </form>
</div>
@endsection