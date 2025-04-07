@extends('layouts.admin_calender')
@section('title', 'スケジュール作成')
@section('content')
<form action="/calendar/store" method="POST">
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

  <!-- 参加グループ選択（複数可） -->
  <label>グループを選択：</label><br>
  <!-- ここはサーバーから取得したグループでループ表示 -->
  <input type="checkbox" name="group_ids[]" value="1"> グループA<br>
  <input type="checkbox" name="group_ids[]" value="2"> グループB<br>

  <button type="submit">登録</button>
</form>

@endsection