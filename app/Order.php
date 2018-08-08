<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'cd_pedido';

    public $timestamps = false;

    protected $fillable = [
        'vl_total', 'cd_status', 'dt_emissao', 'dt_ult_alteracao', 'cd_end_entrega', 'cd_pagseguro',
    ];
}
