<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductVariationRequest extends FormRequest
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
            'cd_ean_variacao' => 'nullable',
            'cd_sku_variacao' => 'required',
            'nm_produto_variacao' => 'required',
            'ds_produto_variacao' => 'required',
            'vl_produto_variacao' => 'required',
            'qt_produto_variacao' => 'required',
            'ds_largura_variacao' => 'required',
            'ds_altura_variacao' => 'required',
            'ds_comprimento_variacao' => 'required',
            'ds_peso_variacao' => 'required',
            'cd_cor_variacao' => 'required',
            'status_variacao' => 'required',
            'images_variacao.*' => 'required|image|mimes:jpeg,bmp,png'
        ];


        if ($this->cd_tamanho_num_variacao == null) {

            $rules['cd_tamanho_letra_variacao'] = 'nullable';

        }

        if ($this->cd_tamanho_letra_variacao == null) {

            $rules['cd_tamanho_num_variacao'] = 'nullable';

        }

        //dd($rules);

        return $rules;
    }
}
