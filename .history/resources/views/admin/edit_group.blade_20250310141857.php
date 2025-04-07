@extends('layouts.admin_calender')
@section('title','グループ編集')
@section('content')

<h1>{{ $group->group_name }} のメンバー</h1>
<ul>
    @foreach($group->users as $user)
        <li>{{ $user->name }}（{{ $user->email }}）</li>
    @endforeach
</ul>
@endsection