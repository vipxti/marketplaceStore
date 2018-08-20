<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    protected $table = 'dado_cliente_sorteio';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome', 'email', 'cpf', 'celular', 'ic_genero'
    ];
}
