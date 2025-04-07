@extends('layouts.admin_calender')
@section('content')
<h1>グループ作成</h1>
<form action="{{ route('groups.store') }}" method="POST">
    @csrf
    <div>
        <label for="group_name">グループ名</label>
        <input type="text" id="group_name" name="group_name" required>
    </div>

    <div>
        <label for="join_id">参加パスワード</label>
        <input type="number" id="join_id" name="join_id" required>
    </div>

    <div>
        <label for="edit_flg">編集可能</label>
        <input type="checkbox" id="edit_flg" name="edit_flg" value="1">
    </div>

    <button type="submit">グループ作成</button>
</form>
@endsection