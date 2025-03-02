<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'join_id', 'edit_flg','user_id','group_id','owner_id'];
}

