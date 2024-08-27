<?php

use App\Http\Controllers\BoostController;
use App\Http\Controllers\DailyRewardController;
use App\Http\Controllers\MineController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//LOGIN-REGISTER
    Route::post('login', [UserController::class, 'Login'])->name('login');
    Route::post('register', [UserController::class, 'Register']);


//profile user for tap and earn coin
//Route::get('/user-info',[ProfileController::class,'getUserinfo']);
Route::middleware('auth:sanctum')->get('/user-info', [ProfileController::class, 'getUserinfo']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/earncoin', [ProfileController::class, 'earnCoin']);
});

//boost
Route::middleware('auth:sanctum')->group(function () {
    Route::post('buy-energy', [BoostController::class, 'BuyEnergy']);
    Route::post('buy-tap', [BoostController::class, 'BuyTap']);
    Route::post('charge-energy', [BoostController::class, 'ChargeEnergy']);
});

//mine
Route::middleware('auth:sanctum')->post('buy-cards',[MineController::class,'buyCards']);

//Get daily reward
Route::middleware('auth:sanctum')->post('daily-reward',[DailyRewardController::class,'dailyReward']);
