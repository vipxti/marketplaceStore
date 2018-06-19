<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'nm_cliente' => 'required|string',
            'dt_nascimento' => 'required',
            'email' => 'required|string',
            'password' => 'required|string',
            'cd_telefone' => 'required',
            'im_cliente' => 'required|image|mimes:jpeg,bmp,png'
        ];
    }
}
