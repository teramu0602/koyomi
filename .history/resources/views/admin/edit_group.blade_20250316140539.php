@extends('layouts.admin_calender')
@section('title','グループ編集')

@section('content')
<pre>{{ print_r($group->users, true) }}</pre>

{{--
<ul>
    if (is_array($groups) || is_object($groups)) {
        @foreach($group->users as $user)
        <li>{{ $user->user_id }}）</li>
        @endforeach
    }
    else {
        echo "データがありません。";
    }
</ul>
--}}

@endsection