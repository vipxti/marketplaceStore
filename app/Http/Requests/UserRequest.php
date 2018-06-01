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
        return [
            'cd_cpf_cnpj' => 'required',
            'nm_usuario' => 'required|string',
            'nm_email' => 'required|email',
            'ds_senha' => 'required|',
            'ic_adm' => 'required',
            'ds_img' => 'required|string',
            'cd_telefone' => 'required',
            'cd_celular1' => 'required',
        ];
    }
}
