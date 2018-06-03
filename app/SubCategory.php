<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categoria';
    protected $primaryKey = 'cd_sub_categoria';

    public $timestamps = false;

    protected $fillable = [
        'nm_sub_categoria'
    ];
}
