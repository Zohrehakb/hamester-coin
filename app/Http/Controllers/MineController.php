<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mine;
use App\Models\Profile;
use Illuminate\Http\Request;
//use Symfony\Component\HttpKernel\Profiler\Profile;

class MineController extends BaseController
{
    public function buyCards(Request $request)
    {
        $user = $request->user();

        $profile = Profile::where('user_id', $user->id)->first();
        if (!$profile) {
            return response()->json(['status' => 'fail', 'message' => 'Profile not found.'], 404);
        }

        $mine = Mine::where('user_id', $user->id)->first();

        if ($mine == null) {
            return response()->json(['status' => 'fail', 'message' => 'Mine not found.'], 404);
        }
        $total_coin = $profile->total_coin;
        $profit = $profile->profit;
        $cards = [
            'card1' => $request->get('card1', 0),
            'card2' => $request->get('card2', 0),
            'card3' => $request->get('card3', 0),
            'card4' => $request->get('card4', 0),
            'card5' => $request->get('card5', 0),
            'card6' => $request->get('card6', 0),
            'card7' => $request->get('card7', 0),
            'card8' => $request->get('card8', 0),
            'card9' => $request->get('card9', 0),
            'card10' => $request->get('card10', 0),
        ];
        $cardValues = [
            'card1' => ['cost' => 25, 'profit' => 75],
            'card2' => ['cost' => 30, 'profit' => 100],
            'card3' => ['cost' => 35, 'profit' => 155],
            'card4' => ['cost' => 40, 'profit' => 200],
            'card5' => ['cost' => 45, 'profit' => 280],
            'card6' => ['cost' => 13, 'profit' => 180],
            'card7' => ['cost' => 18, 'profit' => 350],
            'card8' => ['cost' => 23, 'profit' => 490],
            'card9' => ['cost' => 28, 'profit' => 560],
            'card10' => ['cost' => 33, 'profit' => 900],
        ];

        if (
            ($cards['card6'] > 0 && !$this->canBuyCard($mine, 1)) ||
            ($cards['card7'] > 0 && !$this->canBuyCard($mine, 2)) ||
            ($cards['card8'] > 0 && !$this->canBuyCard($mine, 3)) ||
            ($cards['card9'] > 0 && !$this->canBuyCard($mine, 4)) ||
            ($cards['card10'] > 0 && !$this->canBuyCard($mine, 5))
        ) {
            return response()->json(['status' => 'fail', 'message' => 'You do not meet the requirements to buy these cards.']);
        }
        $totalCost = 0;
        $totalProfit = 0;
        foreach ($cards as $card => $quantity) {
            if ($quantity > 0) {
                $totalCost += $cardValues[$card]['cost'] * $quantity;
                $totalProfit += $cardValues[$card]['profit'] * $quantity;
            }

        }
        if ($mine->total_coin < $totalCost) {
            return response()->json(['status' => 'fail', 'message' => 'Not enough coins.'], 400);
        }
        $profile->total_coin -= $totalCost;
        $profile->save();

        $mine->total_coin -= $totalCost;
        $mine->profit += $totalProfit;
        //add cost
        foreach ($cards as $card => $quantity) {
            if ($quantity > 0) {
                $mine->$card += $quantity;
                $cardValues[$card]['cost'] += 6;
            }
        }
        $mine->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Cards purchased successfully.',
            'total_coin' => $mine->total_coin,
            'profit' => $mine->profit,
            'cards' => $cards,
        ]);
    }

    private function canBuyCard($mine, $times)
    {
        return (
            $mine->card1 >= $times &&
            $mine->card2 >= $times &&
            $mine->card3 >= $times &&
            $mine->card4 >= $times &&
            $mine->card5 >= $times &&
            ($times < 2 || $mine->card6 >= $times - 1) &&
            ($times < 3 || $mine->card7 >= $times - 2) &&
            ($times < 4 || $mine->card8 >= $times - 3) &&
            ($times < 5 || $mine->card9 >= $times - 4) &&
            ($times < 6 || $mine->card10 >= $times - 5)

        );

    }

}
