<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'usuario';
    protected $primaryKey = 'cd_usuario';

    public $timestamps = false;

    protected $fillable = [
        'cd_cpf_cnpj', 'nm_usuario', 'nm_email', 'ds_senha', 'ic_adm', 'ds_img', 'cd_telefone',
    ];

    protected $hidden = [
        'ds_senha'
    ];
}
