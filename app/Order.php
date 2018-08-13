<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'cd_pedido';

    public $timestamps = false;

    protected $fillable = [
        'vl_total', 'cd_status','cd_referencia', 'cd_pagseguro', 'dt_compra', 'vl_frete', 'cd_cliente'
    ];
}
