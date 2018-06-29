<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    protected $table ='uf';
    protected $primaryKey='cd_uf';

    public $timestamps = false;

    protected $fillable = [
        'sg_uf','cd_pais'
    ];
}
