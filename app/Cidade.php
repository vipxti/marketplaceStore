<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table ='cidade';
    protected $primaryKey='cd_cidade';

    public $timestamps = false;

    protected $fillable = [
        'nm_cidade','cd_ibge','cd_uf'
    ];
}
