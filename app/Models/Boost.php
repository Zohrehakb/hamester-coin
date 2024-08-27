<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Boost extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = ['user_id','total_coin','total_energy','earn_per_tap','charge_energy','buy_tap','buy_energy'];
}
