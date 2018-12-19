<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentariosRequest extends FormRequest
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
            'titulo_comentario' => 'nullable',
            'desc_comentario' => 'nullable',
            'fk_id_cliente' => 'nullable',
            'fk_id_star' => 'nullable',
            'fk_id_sku' => 'nullable',
            'slug' => 'nullable',
            'recomenda' => 'nullable',
        ];
    }
}
