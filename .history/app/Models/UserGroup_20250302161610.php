<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
        // $fillableや$guardedの設定を行う
        protected $fillable = ['user_id', 'group_id', 'owner_id', ];
}
