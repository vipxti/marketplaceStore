<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video_yt';
    protected $primaryKey = 'id_video';

    public $timestamps = false;

    protected $fillable = [
        'titulo_video', 'url_video'
    ];
}
