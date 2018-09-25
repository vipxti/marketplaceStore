<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vitrine extends Model{

    protected $table = 'vitrine';
    protected $primaryKey = 'id_vitrine';

    public $timestamps = false;

    protected $fillable = [
        'fk_produto_id',
        'ativo_vitrine'
    ];
}
