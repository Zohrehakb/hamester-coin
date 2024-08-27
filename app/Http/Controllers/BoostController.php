<?php



namespace App\Http\Controllers;

    use App\Http\Controllers\Controller;
    use App\Models\Profile;
    use Illuminate\Http\Request;

class BoostController extends BaseController
{
    public function BuyEnergy(Request $request)
    {
        $user = $request->user();

        $profile = Profile::where('user_id', $user->id)->first();
        if ($profile == null) {
            return response()->json(['error' => 'Profile not found']);
        }
        $total_coin = $profile->total_coin;
        $total_energy = $profile->total_energy;
        $charge_energy = $profile->charge_energy;
        $buy_energy = $profile->buy_energy;

        $cost_energy = $buy_energy;

        if ($total_coin >= $cost_energy) {
            $profile->total_coin -= $cost_energy;
            $profile->total_energy += 50;
            $profile->charge_energy += 50;
            $profile->buy_energy += 10;
            $profile->save();

            return response()->json(['success' => true, 'total_energy' => $profile->total_energy, 'total_coin' => $profile->total_coin]);
        } else {
            return response()->json(['error' => 'Not enough coins', 'total_coin' => $profile->total_coin]);
        }

    }

    public function BuyTap(Request $request)
    {
        $user = $request->user();
        $profile = Profile::where('user_id', $user->id)->first();
        if (!$profile) {
            return response()->json(['error' => 'Profile not found']);
        }
        $total_coin = $profile->total_coin;
        $earn_per_tap = $profile->earn_per_tap;
        $buy_tap = $profile->buy_tap;

        $cost_tap = $buy_tap;

        if ($total_coin >= $cost_tap) {
            $profile->total_coin -= $cost_tap;
            $profile->earn_per_tap += 1;
            $profile->buy_tap += 5;
            $profile->save();


            return response()->json(['success' => true, 'earn_per_tap' => $profile->earn_per_tap, 'total_coin' => $profile->total_coin]);
        } else {
            return response()->json(['error' => 'Not enough coins', 'total_coin' => $profile->total_coin]);
        }

    }

    public function ChargeEnergy(Request $request)
    {
        $user = $request->user();

        $profile = Profile::where('user_id', $user->id)->first();
        if ($profile == null) {
            return response()->json(['error' => 'Profile not found']);
        }
        $profile->total_energy = $profile->charge_energy;
        $profile->save();

        return response()->json([
            'success' => true,
            'total_energy' => $profile->total_energy
        ]);
    }
}


