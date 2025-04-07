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


    
        // Userとのリレーション（←これがないとエラーになる）
        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
}
