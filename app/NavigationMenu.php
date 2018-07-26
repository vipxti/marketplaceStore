<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    //
    protected $table = 'menu_ou_categoria';
    protected $primaryKey = 'menu_ativo';

    public $timestamps = false;

    protected $fillable = [
        'menu_ativo'
    ];
}
