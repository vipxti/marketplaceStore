<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'dados_empresa';
    protected $primaryKey = 'cd_dados_empresa';

    public $timestamps = false;

    protected $fillable = [
        'cd_dados_empresa',
        'nm_razao_social',
        'nm_fantasia',
        'ic_tipo_pessoa',
        'cd_cnpj',
        'cd_ie',
        'ic_ie_isento',
        'cd_im',
        'nm_cnae',
        'cd_regime_tributario',
        'cd_api_bling',
        'cd_api_key',
        'im_logo',
        'ds_complemento',
        'ds_ponto_referencia',
        'fk_cd_telefone',
        'fk_cd_endereco'
    ];
}
