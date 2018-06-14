<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table ='pais';
    protected $primaryKey='cd_pais';

    public $timestamps = false;

    protected $fillable = [
        'nm_pais'
    ];
}
