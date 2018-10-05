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
        $rules = [
            'nm_produto' => 'required|string',
            'cd_ean' => 'nullable|string',
            'cd_sku' => 'required|string',
            'ds_produto' => 'required|string',
            'nm_marca' => 'string',
            'vl_produto' => 'required|string',
            'qt_produto' => 'required|numeric',
            'cd_categoria' => 'required|numeric',
            'cd_sub_categoria' => 'required|numeric',
            'ds_altura' => 'required|numeric',
            'ds_largura' => 'required|numeric',
            'ds_comprimento' => 'required|numeric',
            'ds_peso' => 'required|numeric',
            'status' => 'nullable',
            'images.*' => 'required|image|mimes:jpeg,bmp,png'
        ];
        return $rules;
    }

    public function messages()
    {
        return [

            'images.required' => 'É preciso escolher pelo menos uma imagem'

        ];
    }
}
