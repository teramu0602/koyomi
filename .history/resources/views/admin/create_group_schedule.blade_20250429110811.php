@extends('layouts.admin_calender')
@section('title', 'スケジュール作成')
@section('content')
<form action="{{ route('group.schedule.store') }}" method="POST">
@if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
  @csrf
  <!-- タイトル -->
  <label>タイトル：</label>
  <input type="text" name="title" required><br>

  <!-- 内容 -->
  <label>内容：</label>
  <textarea name="content" required></textarea><br>

  <!-- 開始日時 -->
  <label>開始日：</label>
  <input type="date" name="start_date" required>
  <input type="time" name="start_time" required><br>

  <!-- 終了日時 -->
  <label>終了日：</label>
  <input type="date" name="end_date" required>
  <input type="time" name="end_time" required><br>

  <input type="hidden" name="group_id" value="{{$group_id}}">

  <button type="submit">登録</button>
</form>





<form action="{{ route('group.schedule.store') }}" method="POST">
        @csrf
        <div class="left">
            <p>
                日付　
                開始：<input type="date" name="start_date" class="w70in" required>　　
                終了：<input type="date" name="end_date" class="w70in" required>
            </p>
            <p>
                時間　
                開始：<input type="time" name="start_time" class="w70in" required>　　    
                終了：<input type="time" name="end_time" class="w70in" required>
            </p>
            <div class="form-group">
                <p>タイトル</p>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <p>内容</p>
            <textarea name="content" class="form-control textarea" required></textarea>
            </div>
        </div>
        <input type="hidden" name="group_id" value="{{$group_id}}">
        <button type="submit">作成する</button>
    </form>
@endsection