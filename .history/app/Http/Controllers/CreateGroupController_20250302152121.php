<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class CreateGroupController extends Controller
{
    //
    public function index()
    {
        // 例: グループを取得する
        $groups = Group::all();
    
        // ビューに渡す
        return view('admin.group_list', compact('groups'));
    }
}
