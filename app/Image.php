<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'img_produto';
    protected $primaryKey = 'cd_img';

    public $timestamps = false;

    protected $fillable = [
        'im_produto'
    ];
}
