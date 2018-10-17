<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'id_banner';

    public $timestamps = false;

    protected $fillable = [
        'titulo_banner', 'img_banner', 'url_banner'
    ];
}
