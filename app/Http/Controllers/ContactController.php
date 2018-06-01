<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function cadastroTelefone(ContactRequest $request) {

        Contact::create([
            'cd_celular1' => $request->cd_celular1,
            'cd_celular2' => $request->cd_celular2
        ]);

    }
}
