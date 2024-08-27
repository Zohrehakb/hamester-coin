<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Profile;
//use Couchbase\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends BaseController
{
    public function getUserinfo(Request $request)
    {
        $user = $request->user();

        if ($user == null) {
            return response()->json(['status' => 'fail', 'message' => 'Invalid user.']);
        }

        $profile = Profile::where('user_id', $user->id)->first();

        if ($profile) {
            $accessToken = $user->createToken('MyAuthApp')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'Login successful', 'profile' => $profile, 'token' => $accessToken]);
        } else {
            $profile = Profile::create(['user_id' => $user->id]);
            $accessToken = $user->createToken('authToken')->plainTextToken;
            return response()->json(['status' => 'success', 'message' => 'Registration successful', 'profile' => $profile, 'token' => $accessToken]);
        }


    }

    public function earnCoin(Request $request )
    {

        $user = $request->user();
        if ($user == null) {
            return response()->json(['status' => 'fail', 'message' => 'Unauthorized. Please provide a valid token.'], 401);
        }
        $profile = Profile::where('user_id', $user->id)->first();

        if ($profile == null) {
            return response()->json(['status' => 'fail', 'message' => 'Profile not found.']);
        }
        //
//        if (Auth::id() !== (int)$id) {
//            return response()->json(['status' => 'fail', 'message' => 'Unauthorized.']);
//        }

        $total_coin = $request->get('total_coin');
        $total_energy = $request->get('total_energy');
        $earn_per_tap = $request->get('earn_per_tap');
        $coin_to_level_up = $request->get('coin_to_level_up');
        $current_level = $request->get('current_level');
        $charge_energy = $request->get('charge_energy');
        $max_level = $request->get('max_level');

        if ($total_energy >= $earn_per_tap) {
            $total_energy -= $earn_per_tap;
            $total_coin += $earn_per_tap;

            if ($total_coin >= $coin_to_level_up && $current_level < $max_level) {
                $current_level += 1;
                $earn_per_tap += 1;
                $total_energy += 50;
                $charge_energy += 50;
                $coin_to_level_up = ceil($coin_to_level_up * 2.5);
            }
            $profile->update([
                'total_coin' => $total_coin,
                'total_energy' => $total_energy,
                'current_level' => $current_level,
                'earn_per_tap' => $earn_per_tap,
                'coin_to_level_up' => $coin_to_level_up,
                'charge_energy' => $charge_energy,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Coins earned successfully',
                'total_coin' => $total_coin,
                'total_energy' => $total_energy,
                'current_level' => $current_level,
                'earn_per_tap' => $earn_per_tap,
                'coin_to_level_up' => $coin_to_level_up,
            ]);
        } else {
            return response()->json(['error' => 'Not enough energy']);
        }

    }


}

