<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'cor';
    protected $primaryKey = 'cd_cor';

    public $timestamps = false;

    protected $fillable = [
        'nm_cor'
    ];
}
