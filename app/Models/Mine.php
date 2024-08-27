<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Mine extends Model
{
    use HasFactory,HasApiTokens;
    protected $fillable = [
        'user_id',
        'total_coin',
        'profit',
        'card1',
        'card2',
        'card3',
        'card4',
        'card5',
        'card6',
        'card7',
        'card8',
        'card9',
        'card10',
    ];
}
