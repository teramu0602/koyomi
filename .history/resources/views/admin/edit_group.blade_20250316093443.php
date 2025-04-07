@extends('layouts.admin_calender')
@section('title','グループ編集')

@section('content')
<h1>{{ $group->group_name }} のメンバー</h1>
<ul>


    if (is_array($groups) || is_object($groups)) {
    @foreach($group)
    <li>{{ $user->group_name }}）</li>
    @endforeach
    }
    else {
    echo "データがありません。";
    }
</ul>
@endsection