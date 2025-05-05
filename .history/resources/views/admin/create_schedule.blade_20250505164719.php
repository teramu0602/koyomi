@extends('layouts.admin_calender')
@section('title', 'スケジュール作成')
@section('content')
<div class="w600">
    <h1 class="h1">スケジュールを作成</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('schedule.store') }}" method="POST">
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
        <button type="submit" class="p-bottom">作成する</button>

        <input type="hidden" name="color" id="color">
    </form>
    <a href="{{ url()->previous() }}">戻る</a>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // 明るめの色にするため、200〜255の範囲に限定
        const getBrightColorValue = () => Math.floor(Math.random() * 56) + 200; // 200〜255

        const r = getBrightColorValue();
        const g = getBrightColorValue();
        const b = getBrightColorValue();

        const rgb = `rgb(${r}, ${g}, ${b})`;
        document.getElementById('color').value = rgb;
    });
</script>
</div>

@endsection