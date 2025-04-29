@extends('layouts.admin_calender')
@section('title', 'スケジュール作成')
@section('content')


<div class="w600">
  <h1>スケジュールを作成</h1>

    @if(session('success'))
      <p style="color: green;">{{ session('success') }}</p>
    @endif
  <form action="{{ route('group.schedule.store') }}" method="POST">
    @csrf
    <div class="left">
    <p class="text-bg">{{ $group_name }}の予定表</p>
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
</div>



<div class="gname">
    <div class="group-names">
        @forelse ($event->groups as $group)
            <span class="text-bg">{{ $group->group_name }}の予定表</span>
        @empty
            <span class="text-bg">グループなし</span> {{-- 空の場合用 --}}
        @endforelse
    </div>

    @php
    $canEdit = $event->groups->isEmpty() || $event->groups->contains(function ($group) {
        return $group->edit_flg == 1;
    });
    @endphp

    @if ($canEdit)
    <div class="button-group">
        <form action="{{ route('group.edit', ['id' => $event->id]) }}" method="get">
            <button type="submit" class="btn-primary">編集</button>
        </form>
        <form action="{{ route('group.destroy', ['id' => $event->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-primaryD">削除</button>
        </form>
    </div>
    @endif
</div>
@endsection