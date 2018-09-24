<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItensVitrine extends Model{

    protected $table ='menu_itens_vitrine';
    protected $primaryKey='id_menu_itens_vitrine';

    public $timestamps = false;

    protected $fillable = [
        'menu_itens_vitrine', 'menu_itens_vitrine_ativo'
    ];
}
