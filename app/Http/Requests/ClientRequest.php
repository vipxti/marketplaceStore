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
            'sobrenome_cliente' => 'required|string',
            'dt_nascimento' => 'required|date_format:d/m/Y',
            'email' => 'required|string',
            'password' => 'required|string',
            'cd_celular1' => 'required',
            'im_cliente' => 'nullable|image|mimes:jpeg,bmp,png'
        ];
    }

    public function messages()
    {
        return [
            'cd_cpf_cnpj.required' => 'Campo CPF/CNPJ é obrigatório',
            'dt_nascimento.date_format:d/m/Y' => 'A data informada é inválida!!!'
        ];
    }
}
