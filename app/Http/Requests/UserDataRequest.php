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
        return [
            'cd_cpf_cnpj' => 'required',
            'nm_usuario' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'cd_telefone' => 'required',
            'cd_endereco' => 'required',
            'im_usuario' => 'required|image|mimes:jpeg,bmp,png'
        ];
    }
}
