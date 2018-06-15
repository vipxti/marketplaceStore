<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'embalagem';
    protected $primaryKey = 'cd_embalagem';

    public $timestamps = false;

    protected $fillable = [
        'ds_altura', 'ds_largura', 'ds_peso', 'ds_comprimento'
    ];
}
