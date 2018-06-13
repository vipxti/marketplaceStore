<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table ='telefone';
    protected $primaryKey='cd_telefone';

    public $timestamps = false;

    protected $fillable = [
        'cd_celular1','cd_celular2'
    ];
}
