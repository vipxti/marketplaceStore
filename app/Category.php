<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'cd_categoria';

    public $timestamps = false;

    protected $fillable = [
        'nm_categoria'
    ];
}
