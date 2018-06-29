<?php

namespace App\Http\Controllers;


use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function calcFrete($cep, $altura, $largura, $peso, $comprimento){

        if($largura < 11)
            $largura = 11;
        if($altura < 2)
            $altura = 2;
        if($comprimento < 16)
            $comprimento = 16;

        $dados = [
            'tipo'              => 'pac,sedex', // Separar opções por vírgula (,) caso queira consultar mais de um (1) serviço. > Opções: `sedex`, `sedex_a_cobrar`, `sedex_10`, `sedex_hoje`, `pac`, 'pac_contrato', 'sedex_contrato' , 'esedex'
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

    public function calcFreteOffline($cep, $peso)
    {
        //$e = DB::select('CALL buscarFrete('.$cep.','.$peso.')');
        $frete = DB::select('CALL buscarFrete(:Cep,:Peso)',[
            ':Cep' => $cep,
            ':Peso' => $peso,
        ]);

        return response()->json([ 'freteCalculado' => $frete ]);
    }

    public function finalizarCompra(Request $request){

        //dd($request->all());

        $largura = $request->largura;
        $altura= $request->altura;
        $comprimento= $request->comprimento;

        if($largura < 11)
            $largura = 11;
        if($altura < 2)
            $altura = 2;
        if($comprimento < 16)
            $comprimento = 16;

        $data['token'] ='98911E4EC1494B7A8C3E8E7C4AD9F181';
        $data['email'] = 'manoel@manoelcastro.com.br';
        $data['currency'] = 'BRL';
        $data['itemId1'] = '1';
        $data['itemQuantity1'] = $request->quantidade;
        $data['itemDescription1'] = $request->descricao;
        $data['itemAmount1'] = $request->valor;
        $data['itemWeight1'] = $request->peso;
        $data['itemWidth1'] = $largura;
        $data['itemHeight1'] = $altura;
        $data['itemLength1'] = $comprimento;
        $data['shippingType'] = $request->tipoServ;
        $data['shippingCost'] = $request->freteval;
        $data['shippingAddressPostalCode'] = '11702690';
        $data['shippingAddressStreet'] = 'Rua Jose Carlixto do Carmo';
        $data['shippingAddressNumber'] = '111';
        $data['shippingAddressComplement'] = 'Apto 505';
        $data['shippingAddressDistrict'] = '';
        $data['shippingAddressCity'] = 'Praia Grande';
        $data['shippingAddressState'] = 'SP';
        $data['shippingAddressCountry'] = '';
        $data['senderName'] = 'Myck Carvalho';
        $data['senderCPF'] = '40949300861';
        $data['senderAreaCode'] = '13';
        $data['senderPhone'] = '974082536';
        $data['senderEmail'] = 'felipecunha_7@hotmail.com';
        $data['redirectURL'] = url('');



        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

        $data = http_build_query($data);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml= curl_exec($curl);

        curl_close($curl);

        $xml= simplexml_load_string($xml);

        //dd($xml);

        //$xml->code;

        return response()->json([ 'codigoCompra' => $xml->code ]);

       /* $data = [
            'items' => [
                [
                    'id' => '1',
                    'description' => $request->descricao,
                    'quantity' => $request->quantidade,
                    'amount' => $request->valor,
                    'weight' => $request->peso,
                    'shippingCost' => '',
                    'width' => $request->largura,
                    'height' => $request->altura,
                    'length' => $request->comprimento,
                ],
            ],
            'shipping' => [
                'address' => [
                    'postalCode' => '11702690',
                    'street' => 'Rua Jose Calixto do Carmo',
                    'number' => '111',
                    'district' => 'Aviação',
                    'city' => 'Praia Grande',
                    'state' => 'SP',
                    'country' => 'BRA',
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
                'phone' => '13974082536',
                'bornDate' => '2018-07-27',
            ]
        ];*/

       /* $r = new PagSeguro;


        $checkout = $r->checkout()->createFromArray($data);

        dd($checkout);*/

        /*$credentials = $p->credentials()->get();

        $information = $checkout->send($credentials); // Retorna um objeto de laravel\pagseguro\Checkout\Information\Information
        if ($information) {
            print_r($information->getCode());
            print_r($information->getDate());
            print_r($information->getLink());
        }*/



    }
}
