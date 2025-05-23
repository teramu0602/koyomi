<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'join_id', 'edit_flg'];

    // UserGroupとのリレーション
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups');  // Groupは多くのUserGroupを持つ
    }
}

