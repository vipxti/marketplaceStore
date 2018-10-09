<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailContato extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $email;
    public $nm_cliente;
    public function __construct($msg, $email, $nm_cliente)
    {
        $this->msg = $msg;
        $this->email= $email;
        $this->nm_cliente= $nm_cliente;
    }

    public function build()
    {
        return $this->subject('Contato site Maktub')
                    ->view('pages.app.emails.contatoEmail')
                    ->with([
                        'msg' => $this->msg,
                        'email' => $this->email,
                        'nome' => $this->nm_cliente,
                    ]);
    }
}
