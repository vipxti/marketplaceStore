<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'pedido';
    protected $primaryKey = 'cd_pedido';

    public $timestamps = false;

    protected $fillable = [
        'vl_total', 'cd_status', 'dt_alteracao', 'cd_referencia', 'cd_pagseguro', 'dt_compra', 'vl_frete', 'cd_cliente', 'fk_end_entrega_id'
    ];
}
