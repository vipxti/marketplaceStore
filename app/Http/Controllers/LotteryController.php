<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotteryController extends Controller
{
    //

    public function showViewParticipant(){
        return view('pages.admin.cadParticipanteSorteio');
    }

    public function showViewPrize(){
        return view('pages.admin.gerarGanhador');
    }
}
