@extends('layouts.admin_calender')
@section('title', 'グループ作成')

@section('content')
<h1 class="h1">グループ作成</h1>
<form action="{{ route('groups.store') }}" method="POST">
    @csrf
    <div>
        <label for="group_name">グループ名</label>
        </br>
        <input type="text" id="group_name" name="group_name" required>
    </div>

    <div>
        <label for="join_id">参加パスワード</label>
        </br>
        <input type="number" id="join_id" name="join_id" required>
    </div>

    <div>
        <input class = checkbox type="checkbox" id="edit_flg" name="edit_flg" value="1">
        <label for="edit_flg">編集可能</label>
    </div>

    <button type="submit">作成する</button>
</form>


@endsection