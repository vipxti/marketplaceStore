<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'nm_embalagem' => 'required',
            'ds_altura' => 'required',
            'ds_largura' => 'required',
            'ds_peso' => 'required',
            'ds_comprimento' => 'required'
        ];
    }
}
