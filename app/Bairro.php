<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairro extends Model
{
    protected $table ='bairro';
    protected $primaryKey='cd_bairro';

    public $timestamps = false;

    protected $fillable = [
        'nm_bairro','cd_cidade'
    ];
}
