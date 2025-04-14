@extends('layouts.admin_calender')
@section('title', 'スケジュール作成')
@section('content')
<form action="group.schedule.store" method="POST">
  @csrf
  <!-- タイトル -->
  <label>タイトル：</label>
  <input type="text" name="title" required><br>

  <!-- 内容 -->
  <label>内容：</label>
  <textarea name="content" required></textarea><br>

  <!-- 開始日時 -->
  <label>開始日：</label>
  <input type="date" name="event_start_date" required>
  <input type="time" name="event_start_time" required><br>

  <!-- 終了日時 -->
  <label>終了日：</label>
  <input type="date" name="event_end_date" required>
  <input type="time" name="event_end_time" required><br>

  <input type="hidden" name="group_id" value="{{$group_id}}">

  <button type="submit">登録</button>
</form>
a
@endsection