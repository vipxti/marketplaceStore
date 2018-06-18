<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $table = 'sku';
    protected $primaryKey = 'cd_sku';

    public $timestamps = false;

    protected $fillable = [
        'cd_nr_sku', 'cd_dimensao'
    ];
}
