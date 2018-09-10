<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlingStore extends Model
{
    //
    protected $table = 'integracao_lojas_bling';
    protected $primaryKey = 'id_loja';

    public $timestamps = false;

    protected $fillable = [
        'id_loja', 'nome_loja'
    ];
}
