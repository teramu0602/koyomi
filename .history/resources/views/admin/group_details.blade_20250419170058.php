@extends('layouts.admin_calender')

@section('title', 'イベント詳細')

@section('content')
    <div class="container mt-4">
        <h2>{{ $event->title }}</h2>

        <p><strong>開始日:</strong> {{ \Carbon\Carbon::parse($event->event_start_date)->format('Y年m月d日') }}</p>

        @if ($event->event_end_date)
            <p><strong>終了日:</strong> {{ \Carbon\Carbon::parse($event->event_end_date)->format('Y年m月d日') }}</p>
        @endif

        <p><strong>内容:</strong></p>
        <div class="mb-3">
            {{ $event->content ?? '（説明はありません）' }}
        </div>

        <p><strong>登録者:</strong> {{ $event->user->name }}</p>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>

        @foreach ($event->groups as $group)
            <p>{{ $group->group_name }}</p>
        @endforeach

        //編集ボタン
        @foreach ($event->groups as $group)
            <p>{{ $group->group_name }}</p>

            @if ($group->edit_flg == 1)
                <a href="{{ route('group.edit', ['id' => $group->id]) }}" class="btn btn-primary">編集</a>
            @endif
        @endforeach
    </div>
@endsection
