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
        dd($this->request);
        return [
            'nm_razao_social' => 'required|string',
            'nm_fantasia' => 'required|string',
            'ic_tipo_pessoa' => 'required|string',
            'cd_cnpj' => 'required|numeric',
            'cd_ie' => 'required|numeric',
            'ic_ie_isento' => 'required|numeric',
            'cd_im' => 'required|numeric',
            'nm_cnae' => 'required|string',
            'cd_regime_tributario' => 'required|numeric',
            'cd_api_bling' => 'required|string',
            'cd_api_key' => 'required|string',
            'fk_cd_telefone' => 'required|numeric',
            'fk_cd_endereco' => 'required|numeric'
        ];
    }
}
