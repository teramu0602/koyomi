@extends('layouts.admin_calender')

@section('title', 'イベント詳細')

@section('content')
    <div class="w800">
        <h1>スケジュール</h1>
        
        <div class="gname text-bg">
            @foreach ($event->groups as $group)
                <p>{{ $group->group_name }}の予定表</p>
            @endforeach
        </div>
        <!-- 編集ボタン -->
        @php
        $canEdit = $event->groups->isEmpty() || $event->groups->contains(function ($group) {
            return $group->edit_flg == 1;
        });
        @endphp

        @if ($canEdit)
            <a href="{{ route('group.edit', ['id' => $event->id]) }}" class="btn btn-primary">編集</a>

            <form action="{{ route('group.destroy', ['id' => $event->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">削除</button>
            </form>
        @endif
        <p><strong>開始日:</strong> {{ \Carbon\Carbon::parse($event->event_start_date)->format('Y年m月d日') }}</p>

        @if ($event->event_end_date)
            <p><strong>終了日:</strong> {{ \Carbon\Carbon::parse($event->event_end_date)->format('Y年m月d日') }}</p>
        @endif

        <p><strong>内容:</strong></p>
        <div class="mb-3">
            {{ $event->content ?? '（説明はありません）' }}
        </div>

        <p><strong>登録者:</strong> {{ $event->user->name }}</p>
        <h2>{{ $event->title }}</h2>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>





    </div>
@endsection
