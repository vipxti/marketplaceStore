<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LetterSize extends Model
{
    protected $table = 'tamanho_letra';
    protected $primaryKey = 'cd_tamanho_letra';

    public $timestamps = false;

    protected $fillable = [
        'nm_tamanho_letra'
    ];
}
