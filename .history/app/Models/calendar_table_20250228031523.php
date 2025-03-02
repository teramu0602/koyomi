<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendar_table extends Model
{
    use HasFactory;
    protected $table = 'calendar_table'; // ← テーブル名を明示
    protected $fillable = ['user_id', 'title', 'description', 'date', 'visibility'];
}

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['group_name', 'join_id', 'edit_flg'];
}
