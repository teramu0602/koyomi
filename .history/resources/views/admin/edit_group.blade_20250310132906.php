@extends('layouts.admin_calender')
@section('title','グループ編集')
@section('content')
@foreach ($groups as $group)
    <li>
        <span class="group-name">{{ $group->group_name }}</span> <!-- group_nameを表示 -->
        <div class="button-container">
            <form action="{{ route('groupedit') }}" method="GET" style="display: inline;">
                <button class="btn1" onclick="toggleMode()">編集</button>
            </form>
            <button class="btn1" onclick="toggleMode()">退会</button>
        </div>
    </li>
    @endforeach
    @endsection