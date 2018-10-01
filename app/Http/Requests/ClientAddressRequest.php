<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientAddressRequest extends FormRequest
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
            'nm_destinatario' => 'required|string',
            'sobrenome_destinatario' => 'required|string',
            'cd_cep' => 'required',
            'nm_pais' => 'required',
            'cd_ibge' => 'required',
            'sg_uf' => 'required',
            'nm_cidade' => 'required',
            'ds_endereco' => 'required',
            'cd_numero_endereco' => 'required',
            'ds_complemento' => 'nullable',
            'ds_ponto_referencia' => 'nullable',
            'nm_bairro' => 'required',
        ];
    }
}
