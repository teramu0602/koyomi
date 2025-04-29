@extends('layouts.admin_calender')

@section('title', 'イベント編集')

@section('content')
    <div class="container mt-4">
        <h2>イベント編集</h2>

        <form action="{{ route('group.update', ['id' => $event->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="event_start_date" class="form-label">開始日</label>
                <input type="date" name="event_start_date" class="form-control" value="{{ old('event_start_date', $event->event_start_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="event_start_time" class="form-label">開始時間</label>
                <input type="time" name="event_start_time" class="form-control" value="{{ old('event_start_time', $event->event_start_time) }}" required>
            </div>

            <div class="mb-3">
                <label for="event_end_date" class="form-label">終了日</label>
                <input type="date" name="event_end_date" class="form-control" value="{{ old('event_end_date', $event->event_end_date) }}">
            </div>

            <div class="mb-3">
                <label for="event_end_time" class="form-label">終了時間</label>
                <input type="time" name="event_end_time" class="form-control" value="{{ old('event_end_time', $event->event_end_time) }}">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">内容</label>
                <textarea name="content" class="form-control" rows="4">{{ old('content', $event->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
    <p style="color: red;">{{ session('error') }}</p>





    <div class="w600">
    <h1>スケジュールを編集</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('group.update', ['id' => $event->id]) }}" method="POST">
        @csrf
        <div class="left">
            <p>
                日付　
                開始：<input type="date" name="start_date" value="{{ old('event_start_date', $event->event_start_date) }}" class="w70in" required>　　
                終了：<input type="date" name="end_date" value="{{ old('event_end_date', $event->event_end_date) }}" class="w70in" required>
            </p>
            <p>
                時間　
                開始：<input type="time" name="start_time" value="{{ old('event_start_time', $event->event_start_time) }}" class="w70in" required>　　    
                終了：<input type="time" name="end_time" value="{{ old('event_end_time', $event->event_end_time) }}" class="w70in" required>
            </p>
            <div class="form-group">
                <p>タイトル</p>
                <input type="text" name="title" value="{{ old('title', $event->title) }}" class="form-control" required>
            </div>
            <div class="form-group">
                <p>内容</p>
            <textarea name="content" class="form-control textarea" required>{{ old('content', $event->content) }}</textarea>
            </div>
        </div>
        <button type="submit">作成する</button>
    </form>
</div>
@endsection
