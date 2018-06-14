<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $table = 'produto_variacao';
    protected $primaryKey = 'cd_produto_variacao';

    public $timestamps = false;

    protected $fillable = [
        'cd_ean_variacao', 'nm_produto_variacao', 'ds_produto_variacao', 'vl_produto_variacao', 'qt_produto_variacao', 'cd_status_produto_variacao', 'cd_sku', 'cd_produto'
    ];
}
