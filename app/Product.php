<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'produto';
    protected $primaryKey = 'cd_produto';

    public $timestamps = false;

    protected $fillable = [
        'cd_ean', 'nm_produto', 'ds_produto', 'vl_produto', 'nm_slug', 'qt_produto', 'cd_status_produto', 'cd_sku', 'marca_id_fk'
    ];
}
