<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlingChannels extends Model
{
    protected $table = 'integracao_canais_bling';
    protected $primaryKey = 'id_canais';

    public $timestamps = false;

    protected $fillable = [
        'nome_canal', 'comissao', 'taxa', 'imposto', 'pac', 'despesa_fixa', 'taxa_cartao', 'marketing'
    ];
}
