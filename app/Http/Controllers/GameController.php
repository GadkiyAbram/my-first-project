<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Mockery\Matcher\Pattern;

class GameController extends Controller
{
    public function index()
    {
        return view('game.index');
    }

    private function getUsdAmount()
    {
        $usdAmount = File::get(storage_path('awards\money'));
        $prize = rand(10, ((int)$usdAmount) / 90000);

        return $prize;
    }

    private function getGift()
    {
        $gifts = File::get(storage_path('awards\gifts'));
        $giftsString = (string)$gifts;
        $giftsArray = preg_split("/,/", $giftsString);
        $indexSelected = rand(0, count($giftsArray, COUNT_NORMAL) - 1);
        $giftSelected = $giftsArray[$indexSelected];

        return $giftSelected;
    }

    public function show()
    {
        $finalPrizeArray = [];

        //Money gifts
        $moneyPrize = $this->getUsdAmount();
        $giftPrize = $this->getGift();
        $bonusGift = rand(0, 100);

//        $moneyUpdt = (int)$usdAmount - $prize;

//        Deleting USD amount from Array
//        $handle = fopen('../storage/awards/money', 'w');
//        fwrite($handle, (string)$moneyUpdt);
//        fclose($handle);

        //Gifts physical

//        unset($giftsArray[$indexSelected]);

//        $newGiftArray = implode(',', $giftsArray);

//        Deleting gift from Array
//        $handle = fopen('../storage/awards/gifts', 'w');
//        fwrite($handle, $newGiftArray);
//        fclose($handle);

        //Bonuses loyalty

        array_push($finalPrizeArray, $moneyPrize, $giftPrize, $bonusGift);

        $finalPrizeIndex = rand(0, count($finalPrizeArray, COUNT_NORMAL) - 1);
        $finalPrize = $finalPrizeArray[$finalPrizeIndex];

        return view('game.show', compact(
//            'moneyPrize',
//            'usdAmount',
//            'giftPrize',
            'finalPrize'
//            'giftsArray',
//        'finalPrizeArray'
        ));
    }

    public function update(Request $request){

        $bonus = Auth::user()->profile->bonus_count;
        $finalBonus = $bonus + $request->input('finalPrize');

        Auth::user()->profile()->update([
            'bonus_count' => $finalBonus
        ]);

        return redirect('game');
    }
}
