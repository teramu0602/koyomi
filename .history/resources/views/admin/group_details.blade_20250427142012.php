@extends('layouts.admin_calender')

@section('title', 'イベント詳細')
@section('css')
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="w600">
        <h1>スケジュール</h1>
        
        <div class="gname">
    @foreach ($event->groups as $group)
        <span class="text-bg">{{ $group->group_name }}の予定表</span>
    @endforeach

    @php
    $canEdit = $event->groups->isEmpty() || $event->groups->contains(function ($group) {
        return $group->edit_flg == 1;
    });
    @endphp

    @if ($canEdit)
        <div class="button-group">
            <form action="{{ route('group.edit', ['id' => $event->id]) }}" method="get" style="display:inline;">
                <button type="submit" class="btn btn-primary">編集</button>
            </form>
            <form action="{{ route('group.destroy', ['id' => $event->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primaryD">削除</button>
            </form>
        </div>
    @endif
</div>
        <p>
            日付： {{ \Carbon\Carbon::parse($event->event_start_date)->format('Y年m月d日') }}
            @if ($event->event_end_date)
                ~{{ \Carbon\Carbon::parse($event->event_end_date)->format('Y年m月d日') }}
            @endif
        </p>
        <p>
            時間：
            {{ \Carbon\Carbon::parse($event->event_start_time)->format('H:i') }}~
            {{ \Carbon\Carbon::parse($event->event_end_time)->format('H:i') }}
        </p>
        <p>作成者: {{ $event->user->name }}</p>
        <p>タイトル</p>
        <h2>{{ $event->title }}</h2>
        <p>内容</p>
        <p>{{ $event->content ?? '（説明はありません）' }}</p>



        
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
    </div>

@endsection
