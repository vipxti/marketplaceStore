<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        return [
            'nm_usuario' => 'required',
            'email' => 'required|string',
            'password' => 'required|string',
            'cd_cpf_cnpj' => 'required'
        ];
    }
}
