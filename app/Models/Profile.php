<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Profile extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'user_id', 'total_coin', 'total_energy', 'used_energy', 'charge_energy',
        'buy_energy', 'earn_per_tab', 'current_level', 'max_level', 'coin_to_level_up', 'buy_tab', 'profit', 'daily_reward_stage'
    ];

}
