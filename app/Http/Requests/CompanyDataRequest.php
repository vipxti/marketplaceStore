<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDataRequest extends FormRequest
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
            'nm_razao_social' => 'required|string',
            'nm_fantasia' => 'nullable',
            'ic_tipo_pessoa' => 'required|string',
            'cd_tel' => 'required|string',
            'cd_cnpj' => 'required|string',
            'cd_ie' => 'nullable',
            'ic_ie_isento' => 'nullable',
            'cd_im' => 'nullable',
            'nm_cnae' => 'nullable',
            'cd_regime_tributario' => 'required|numeric',
            'cd_api_bling' => 'required|string',
            'cd_api_key' => 'required|string',
            'cd_cep' => 'required|string',
            'nm_cidade' => 'required|string',
            'cd_ibge' => 'required',
            'ds_endereco' => 'required|string',
            'cd_numero_endereco' => 'required|numeric',
            'ds_complemento' => 'nullable',
            'ds_ponto_referencia' => 'nullable',
            'nm_bairro' => 'required|string',
            'sg_uf' => 'required|string',
            'nm_pais' => 'required|string',
            'image' => 'nullable',
        ];
    }
}
