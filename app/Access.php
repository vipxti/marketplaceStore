<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'acesso';
    protected $primaryKey = 'cd_acesso';

    public $timestamps = false;

    protected $fillable = [
        'nm_acesso'
    ];
}
