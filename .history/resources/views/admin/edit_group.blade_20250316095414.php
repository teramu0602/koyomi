@extends('layouts.admin_calender')
@section('title','グループ編集')

@section('content')
<h1>{{ $group->user_id }} のメンバー</h1>

{{--
<ul>
    if (is_array($groups) || is_object($groups)) {
        @foreach($group->users as $user)
        <li>{{ $user->group_name }}）</li>
        @endforeach
    }
    else {
        echo "データがありません。";
    }
</ul>
--}}

@endsection