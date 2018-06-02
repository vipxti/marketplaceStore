<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'tamanho';
    protected $primaryKey = 'cd_tamanho';

    public $timestamps = false;

    protected $fillable = [
        'nm_tamanho'
    ];
}
