<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'cd_celular1'=>'required',
            'cd_celular2'=>'nullable',
            'cd_cep'=>'required',
            'nm_cidade'=>'required',
            'ds_endereco'=>'required',
            'ds_numero_endereco'=>'required',
            'ds_complemento'=>'required',
            'ds_ponto_referencia'=>'required',
            'nm_bairro'=>'required',
            'nm_pais'=>'required',
            'image'=>'required'
        ];
    }
}
