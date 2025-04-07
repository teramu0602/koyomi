@extends('layouts.admin_calender')
@section('title','グループ編集')
@section('content')
<ul>
    @foreach($group->users as $user)
        <li>{{ $user->name }}（{{ $user->email }}）</li>
    @endforeach
</ul>
@endsection