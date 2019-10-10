<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mockery\Matcher\Pattern;

class GameController extends Controller
{
    public function index()
    {
        $finalPrizeArray = [];

        //Money gifts
        $file = File::get(storage_path('awards\money'));
        $prize = rand(10, ((int)$file) / 9000);
//        $moneyUpdt = (int)$file - $prize;

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
        $bonus = rand(1, 100);

        array_push($finalPrizeArray, $prize . ' USD', $giftSelected, $bonus . ' bonuses');

        $finalPrizeIndex = rand(0, count($finalPrizeArray, COUNT_NORMAL) - 1);
        $finalPrize = $finalPrizeArray[$finalPrizeIndex];

        return view('game.index', compact('prize',
//            'moneyUpdt',
            'giftsArray',
            'giftSelected',
            'finalPrize'));
    }
}
