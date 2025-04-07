<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;
        
    // $fillableや$guardedの設定を行う
        protected $fillable = ['user_id', 'group_id', 'owner_flg'];
        
        // リレーションの定義
    public function group()
    {
        return $this->belongsTo(Group::class);  // UserGroupはGroupに属している
    }


    
        // Usersとのリレーション（←これがないとエラーになる）
        public function users(): BelongsToMany
        {
            return $this->belongsToMany(User::class, 'user_group_table', 'group_id', 'user_id');
        }
}
