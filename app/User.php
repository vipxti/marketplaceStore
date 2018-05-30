<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guard = 'usuario';
    protected $table = 'usuario';
    protected $primaryKey = 'cd_usuario';

    use Notifiable;

    protected $fillable = [
        'cd_cpf_cnpj', 'nm_usuario', 'nm_email', 'ds_senha', 'ic_adm', 'ds_img', 'cd_telefone',
    ];

    protected $hidden = [
        'ds_senha', 'remember_token',
    ];
}
