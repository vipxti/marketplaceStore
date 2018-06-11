<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'cd_menu';

    public $timestamps = false;

    protected $fillable = [
        'nm_menu'
    ];
}
