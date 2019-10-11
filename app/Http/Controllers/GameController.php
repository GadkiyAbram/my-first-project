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

    }

    private function getGift()
    {

    }

    public function show()
    {
        $finalPrizeArray = [];

        //Money gifts
        $usdAmount = File::get(storage_path('awards\money'));
        $prize = rand(10, ((int)$usdAmount) / 9000);
//        $moneyUpdt = (int)$usdAmount - $prize;

//        Deleting USD amount from Array
//        $handle = fopen('../storage/awards/money', 'w');
//        fwrite($handle, (string)$moneyUpdt);
//        fclose($handle);

        //Gifts phisical
        $file = File::get(storage_path('awards\gifts'));
        $giftsString = (string)$file;
        $giftsArray = preg_split("/,/", $giftsString);

        $indexSelected = rand(0, count($giftsArray, COUNT_NORMAL) - 1);
        $giftSelected = $giftsArray[$indexSelected];

        unset($giftsArray[$indexSelected]);

        $newGiftArray = implode(',', $giftsArray);

//        Deleting gift from Array
//        $handle = fopen('../storage/awards/gifts', 'w');
//        fwrite($handle, $newGiftArray);
//        fclose($handle);

        //Bonuses loyalty
        $bonus = rand(0, 100);

        array_push($finalPrizeArray, $prize . ' USD', $giftSelected, $bonus);

        $finalPrizeIndex = rand(0, count($finalPrizeArray, COUNT_NORMAL) - 1);
        $finalPrize = $finalPrizeArray[$finalPrizeIndex];

        return view('game.show', compact('prize',
            'usdAmount',
            'giftsArray',
            'giftSelected',
            'finalPrize'));
    }

    public function update(Request $request){

        $bonus = Auth::user()->profile->bonus_count;
        $finalBonus = $bonus + $request->input('prize');

        Auth::user()->profile()->update([
            'bonus_count' => $finalBonus
        ]);

        return redirect('game');
    }
}
