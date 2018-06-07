<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NumberSize extends Model
{
    protected $table = 'tamanho_num';
    protected $primaryKey = 'cd_tamanho_num';

    public $timestamps = false;

    protected $fillable = [
        'nm_tamanho_num'
    ];
}
