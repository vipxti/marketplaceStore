<?php

namespace App\Http\Controllers;

use App\Mail\mailContato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function enviaEmail(Request $request){
        Mail::to('comercial@vipx.com.br')->send(new mailContato($request->msg_cliente, $request->email_cliente, $request->nm_cliente));

        /*$msg = [$request->msg_cliente];

        Mail::send(new mailContato(), [], function($message){
            $message->to('vipxti@gmail.com');
            $message->subject('Contato cliente site Maktub');
        });*/

        return redirect()->route('index');
    }
}
