<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table ='endereco';
    protected $primaryKey='cd_endereco';

    public $timestamps = false;

    protected $fillable = [
        'cd_cep',
        'ds_endereco',
        'cd_numero_endereco',
        'ds_complemento',
        'ds_ponto_referencia',
        'cd_bairro'
    ];
}
