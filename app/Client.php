<?php

namespace App;

use App\Notifications\ClientResetPassordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use Notifiable;

    protected $guard = 'user';
    protected $table = 'cliente';
    protected $primaryKey = 'cd_cliente';

    public $timestamps = false;

    protected $fillable = [
        'cd_cpf_cnpj', 'nm_cliente', 'sobrenome_cliente', 'email', 'password', 'dt_nascimento', 'im_cliente', 'cd_telefone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new  ClientResetPassordNotification($token));
    }

}
