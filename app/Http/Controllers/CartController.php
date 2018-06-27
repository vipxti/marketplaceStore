<?php

namespace App\Http\Controllers;

use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function calcFrete($cep, $altura, $largura, $peso, $comprimento){

        $dados = [
            'tipo'              => 'sedex', // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
            'formato'           => 'caixa', // opções: `caixa`, `rolo`, `envelope`
            'cep_destino'       => $cep, // Obrigatório
            'cep_origem'        => '11365230', // Obrigatorio
            //'empresa'         => '', // Código da empresa junto aos correios, não obrigatório.
            //'senha'           => '', // Senha da empresa junto aos correios, não obrigatório.
            'peso'              => $peso, // Peso em kilos
            'comprimento'       => $comprimento, // Em centímetros
            'altura'            => $altura, // Em centímetros
            'largura'           => $largura, // Em centímetros
            'diametro'          => '0', // Em centímetros, no caso de rolo
            // 'mao_propria'       => '1', // Não obrigatórios
            // 'valor_declarado'   => '1', // Não obrigatórios
            // 'aviso_recebimento' => '1', // Não obrigatórios
        ];

        $c = new CorreiosConsulta;

        $frete = $c->frete($dados);

        /*$dados = [
            0 => $altura,
            1 => $largura,
            2 => $peso,
            3 => $comprimento,
        ];*/

        return response()->json([ 'freteCalculado' => $frete ]);

    }
}
