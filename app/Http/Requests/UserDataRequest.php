<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //dd($this->request);

        $rules = [
            'nm_usuario' => 'string',
            'email' => 'email|string',
            ];

        if ($this->password != null) {

            $rules['password'] = 'string';

        }

        if ($this->cd_acesso != null) {

            $rules['cd_acesso'] = 'numeric';

        }

        return $rules;
    }
}
