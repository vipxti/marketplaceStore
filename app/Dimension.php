<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    protected $table = 'dimensao';
    protected $primaryKey = 'cd_dimensao';

    public $timestamps = false;

    protected $fillable = [
        'ds_altura', 'ds_largura', 'ds_peso', 'ds_comprimento'
    ];
}
