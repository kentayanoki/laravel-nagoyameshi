<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;

class PaidUser extends Model
{
    public $timestamps = false; // 自動的な更新を無効にする

    protected $fillable = [
        'card_created_at', 
        'card_updated_at',
        // 他のフィールドもここに追加
    ];

    protected $dates = [
        'card_created_at', 
        'card_updated_at'
    ];
    
    // タイムスタンプを手動で設定する方法を提供する
    public function setCreatedAt($value)
    {
        $this->attributes['card_created_at'] = $value;
    }

    public function setUpdatedAt($value)
    {
        $this->attributes['card_updated_at'] = $value;
    }

    public function User()
    {
        return $this->hasOne(User::class);
    }
}
