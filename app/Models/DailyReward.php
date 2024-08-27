<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class DailyReward extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = ['user_id','total_coin','daily_reward','last_reward_at'];
}
