<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $primaryKey = 'id_wishlist';

    public $timestamps = false;

    protected $fillable = [
        'fk_id_cliente', 'fk_id_sku'
    ];
}
