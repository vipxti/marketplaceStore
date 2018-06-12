<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        $rules = [
            'nm_produto' => 'required|string',
            'cd_ean' => 'nullable|string',
            'cd_sku' => 'required|string',
            'ds_produto' => 'required|string',
            'vl_produto' => 'required|numeric',
            'qt_produto' => 'required|numeric',
            'cd_categoria' => 'required|numeric',
            'cd_sub_categoria' => 'required|numeric',
            'cd_embalagem' => 'required|numeric',
            'status' => 'required|string',
            'images.*' => 'required|image|mimes:jpeg,bmp,png'
        ];

//        if ($this->cd_tamanho_num == null) {
//
//            $rules['cd_tamanho_letra'] = 'required';
//
//        }
//
//        if ($this->cd_tamanho_letra == null) {
//
//            $rules['cd_tamanho_num'] = 'required';
//
//        }

        return $rules;

    }

    public function messages()
    {
        return [

            'images.required' => 'É preciso escolher pelo menos uma imagem'

        ];
    }

}
