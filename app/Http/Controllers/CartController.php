<?php

namespace App\Http\Controllers;


use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Http\Request;
use laravel\pagseguro\Facades\PagSeguro;

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

        $c = new CorreiosConsulta();

        $frete = $c->frete($dados);

        /*$dados = [
            0 => $altura,
            1 => $largura,
            2 => $peso,
            3 => $comprimento,
        ];*/

        return response()->json([ 'freteCalculado' => $frete ]);

    }

    public function finalizarCompra(Request $request){

        //dd($request->all());

        $data = [
            'items' => [
                [
                    'id' => '1',
                    'description' => $request->descricao,
                    'quantity' => $request->quantidade,
                    'amount' => $request->valor,
                    'weight' => $request->peso,
                    'shippingCost' => '3.5',
                    'width' => $request->largura,
                    'height' => $request->altura,
                    'length' => $request->comprimento,
                ],
            ],
            'shipping' => [
                'address' => [
                    'postalCode' => $request->cep,
                    'street' => $request->endereco,
                    'number' => $request->numero,
                    'district' => $request->bairro,
                    'city' => $request->cidade,
                    'state' => $request->estado,
                    'country' => $request->pais,
                ],
                'type' => '',
                'cost' => '',
            ],
            'sender' => [
                'email' => $request->email_cliente,
                'name' => $request->nome,
                'documents' => [
                    [
                        'number' => $request->numero_cpf,
                        'type' => 'CPF'
                    ]
                ],
                'phone' => '11985445522',
                'bornDate' => '1988-03-21',
            ]
        ];

        dd($data);

        $checkout = PagSeguro::checkout()->createFromArray($data);

        $credentials = PagSeguro::credentials()->get();
        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
        if ($information) {
            print_r($information->getCode());
            print_r($information->getDate());
            print_r($information->getLink());
        }



    }
}
