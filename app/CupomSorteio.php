<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CupomSorteio extends Model
{
    protected $table = 'sorteio';
    protected $primaryKey = 'id_sorteio';

    public $timestamps = false;

    protected $fillable = [
        'fk_id_cliente'
    ];
}
