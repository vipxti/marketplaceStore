<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table = 'sub_menu';
    protected $primaryKey = 'cd_sub_menu';

    public $timestamps = false;

    protected $fillable = [
        'nm_sub_menu'
    ];
}
