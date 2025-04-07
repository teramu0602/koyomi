<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'calendars'; // テーブル名

    protected $fillable = [
        'event_start_date',
        'event_start_time',
        'event_end_date',
        'event_end_time',
        'user_id',
        'title',
        'content'
    ];

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 複数のグループに紐づく
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'calendar_groups', 'calendar_id', 'group_id');
    }
}
