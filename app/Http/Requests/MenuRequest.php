<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
//            'nm_menu1' => 'string',
//            'nm_sub_menu1.*' => 'string',
//
//            'nm_menu2' => 'string',
//            'nm_sub_menu2.*' => 'string',
//
//            'nm_menu3' => 'string',
//            'nm_sub_menu3.*' => 'string',
//
//            'nm_menu4' => 'string',
//            'nm_sub_menu4.*' => 'string',
//
//            'nm_menu5' => 'string',
//            'nm_sub_menu5.*' => 'string'
        ];
    }
}
