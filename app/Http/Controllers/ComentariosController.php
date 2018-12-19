<?php

namespace App\Http\Controllers;

use App\Comentarios;
use App\Http\Requests\ComentariosRequest;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function saveComentario(ComentariosRequest $request){
        //dd($request->all());
        try{
            $data = date('Y-m-d');

            Comentarios::firstOrCreate([
                'titulo_comentario' => $request->titulo_comentario,
                'desc_comentario' => $request->desc_comentario,
                'fk_id_cliente' => $request->fk_id_cliente,
                'fk_id_star' => $request->fk_id_star,
                'fk_id_sku' => $request->fk_id_sku,
                'dt_comentario' => $data,
                'recomenda' => $request->recomenda,
            ]);
        } catch (\Exception $e){
            return redirect()->route('products.details', $request->slug);
        }

        return redirect()->route('products.details', $request->slug);
    }
}
