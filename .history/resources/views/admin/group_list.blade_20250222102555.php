@extends('layouts.admin_calender')
<head>
<link href="{{ asset('css/common.admin.css') }}" rel="stylesheet">
</head>

@section('content')
<div class = "container">
<button class="switch_button" onclick="toggleMode()">グループ / 個人</button>
</div>
    <!-- データがある場合はリスト表示、ない場合はメッセージ表示 -->
    @if ($groups->isEmpty())
        <p>まだグループがありません。</p>
    @else
        <ul>
            @foreach ($groups as $group)
                <li>{{ $group->group_name }}</li> <!-- group_nameを表示 -->
            @endforeach
        </ul>
    @endif
<p class = "purple">青</p>
@endsection