<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function listOrder()
    {

        $dadosEmpresa = DB::table('dados_empresa')
            ->join('telefone', 'dados_empresa.fk_cd_telefone', '=', 'telefone.cd_telefone')
            ->join('endereco', 'dados_empresa.fk_cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'nm_fantasia',
                'cd_cnpj',
                'cd_telefone_fixo',
                'im_logo',
                'cd_numero_endereco',
                'ds_complemento',
                'cd_cep',
                'ds_endereco',
                'nm_bairro',
                'nm_cidade',
                'sg_uf'
            )
            ->get();
        $cnpj = (string) $dadosEmpresa[0]->cd_cnpj;
        $phone = (string) $dadosEmpresa[0]->cd_telefone_fixo;
        $cep = (string) $dadosEmpresa[0]->cd_cep;
        $eCnpj =  $this->mask($cnpj,'##.###.###/####-##');
        $ePhone = $this->mask($phone,'(##) ####-####');
        $eCep = $this->mask($cep,'#####-###');

        /*$dadosCliente = DB::table('cliente')
            ->where('cliente.cd_cliente', '=', $codNum)
            ->join('telefone', 'cliente.cd_telefone', '=', 'telefone.cd_telefone')
            ->join('cliente_endereco', 'cliente.cd_cliente', '=', 'cliente_endereco.cd_cliente')
            ->join('endereco', 'cliente_endereco.cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->select(
                'nm_cliente',
                'cd_cpf_cnpj',
                'email',
                'cd_celular1',
                'cd_celular2',
                'nm_destinatario',
                'cd_numero_endereco',
                'ds_complemento',
                'ds_ponto_referencia',
                'cd_cep',
                'ds_endereco',
                'nm_bairro',
                'nm_bairro',
                'sg_uf'
            )
            ->get();
        dd($dadosCliente);*/


        $listOrder = Order::paginate(15);

        return view('pages.admin.listOrder', compact('listOrder', 'dadosEmpresa', 'eCnpj', 'ePhone', 'cep'));
    }

    function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
            if($mask[$i] == '#'){
                if(isset($val[$k]))
                    $maskared .= $val[$k++];
            }
            else{
                if(isset($mask[$i])){
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }
}
