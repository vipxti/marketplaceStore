<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $primaryKey = 'id_comentario';
    protected $table = 'comentarios';

    public $timestamps = false;

    protected $fillable = [
        'desc_comentario', 'fk_id_cliente', 'dt_comentario', 'fk_id_star', 'fk_id_sku', 'titulo_comentario', 'recomenda'
    ];
}
