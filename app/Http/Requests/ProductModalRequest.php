<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductModalRequest extends FormRequest
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

        $rules = [
            'cd_ean' => 'required',
            'cd_sku' => 'required',
            'nm_produto' => 'required',
            'ds_produto' => 'required',
            'vl_produto' => 'required',
            'cd_categoria' => 'required',
            'cd_sub_categoria' => 'required',
            'cd_cor' => 'required',
            'ds_altura' => 'required',
            'ds_largura' => 'required',
            'ds_peso' => 'required',
            'status' => 'required',
            'images.*' => 'required|image|mimes:jpeg,bmp,png'
        ];


        if ($this->cd_tamanho_num == null) {

            $rules['cd_tamanho_letra'] = 'required';

        }

        if ($this->cd_tamanho_letra == null) {

            $rules['cd_tamanho_num'] = 'required';

        }

        //dd($rules);

        return $rules;

    }
}
