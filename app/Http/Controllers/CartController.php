<?php

namespace App\Http\Controllers;

use Cagartner\CorreiosConsulta\CorreiosConsulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Product;
use App\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    public function showCartPage()
    {
        if (Auth::check()) {
            $telefoneCliente = Client::join('telefone', 'cliente.cd_telefone', 'telefone.cd_telefone')->select('telefone.cd_celular1')->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)->get()->toArray();
        } else {
            $telefoneCliente = null;
            if (!(Session::has('cartRoute'))) {
                Session::put('cartRoute', 'cart.page');
            }
        }

        $enderecoCliente = Client::join('cliente_endereco', 'cliente.cd_cliente', 'cliente_endereco.cd_cliente')->join('endereco', 'endereco.cd_endereco', 'cliente_endereco.cd_endereco')->join('bairro', 'bairro.cd_bairro', 'endereco.cd_bairro')->join('cidade', 'bairro.cd_cidade', 'cidade.cd_cidade')->join('uf', 'uf.cd_uf', 'cidade.cd_uf')->join('pais', 'pais.cd_pais', 'uf.cd_pais')->select('endereco.cd_cep', 'endereco.ds_endereco', 'endereco.cd_numero_endereco', 'cliente_endereco.ds_complemento', 'bairro.nm_bairro', 'cidade.nm_cidade', 'uf.sg_uf', 'pais.nm_pais')->where('cliente_endereco.ic_principal', '=', 1)->get();

        $telefone = $telefoneCliente[0]['cd_celular1'];

        return view('pages.app.carrinho', compact('telefone', 'enderecoCliente'));
    }

    public function showResultPage()
    {
        return view('pages.app.cart.result');
    }

    public function calcFrete($cep, $altura, $largura, $peso, $comprimento)
    {
        if ($largura < 11) {
            $largura = 11;
        }
        if ($altura < 2) {
            $altura = 2;
        }
        if ($comprimento < 16) {
            $comprimento = 16;
        }

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
        $frete = DB::select('CALL buscarFrete(:Cep,:Peso)', [
            ':Cep' => $cep,
            ':Peso' => $peso,
        ]);

        return response()->json([ 'freteCalculado' => $frete ]);
    }

    public function addToCart(Request $request)
    {
        //dd($request->all());

        //Verificar se já tem produto no carrinho
        //Se tem, acrescentar a quantidade
        //Se não tem, salvar na session o primeiro produto
        
        //verificar se o produto acrescentado é diferente
        //Se for, fazer a lógica de acrecentar na tabela do carrinho

        if ($this->verificaProduto($request->sku_produto)) {
            $index = Session::get('idx' . $request->sku_produto);
            $produtosCarrinho = Session::get('cart');

            $alturaTotal = Session::get('totalHeight');
            $larguraTotal = Session::get('totalWidth');
            $comprimentoTotal = Session::get('totalLength');
            $pesoTotal = Session::get('totalWeight');

            $alturaTotalIndividual = $produtosCarrinho[$index]['alturaTotalProduto'];
            $larguraTotalIndividual = $produtosCarrinho[$index]['larguraTotalProduto'];
            $comprimentoTotalIndividual = $produtosCarrinho[$index]['comprimentoTotalProduto'];
            $pesoTotalIndividual = $produtosCarrinho[$index]['pesoTotalProduto'];

            $precoSubTotal = Session::get('subtotalPrice');
            $precoTotal = Session::get('totalPrice');

            $alturaTotal += $produtosCarrinho[$index]['alturaProduto'];
            $larguraTotal += $produtosCarrinho[$index]['larguraProduto'];
            $comprimentoTotal += $produtosCarrinho[$index]['comprimentoProduto'];
            $pesoTotal += $produtosCarrinho[$index]['pesoProduto'];

            $alturaTotalIndividual += $produtosCarrinho[$index]['alturaProduto'];
            $larguraTotalIndividual += $produtosCarrinho[$index]['larguraProduto'];
            $comprimentoTotalIndividual += $produtosCarrinho[$index]['comprimentoProduto'];
            $pesoTotalIndividual += $produtosCarrinho[$index]['pesoProduto'];

            //dd($produtosCarrinho[$index]['qtdIndividual']);
            
            $qtdIndividual = intval($produtosCarrinho[$index]['qtdIndividual']);
            $qtdIndividual++;
            $qtdProdutosCarrinho = intval(Session::get('qtCart'));

            //dd($produtosCarrinho[$index]['valorProduto']);
            //dd($qtdIndividual);

            $valorTotal = $produtosCarrinho[$index]['valorProduto'] * $qtdIndividual;
            $qtdProdutosCarrinho++;
            //dd($valorTotal);

            $produtosCarrinho[$index]['qtdIndividual'] = $qtdIndividual;
            $produtosCarrinho[$index]['valorTotalProduto'] = $valorTotal;

            $produtosCarrinho[$index]['alturaTotalProduto'] = $alturaTotalIndividual;
            $produtosCarrinho[$index]['larguraTotalProduto'] = $larguraTotalIndividual;
            $produtosCarrinho[$index]['comprimentoTotalProduto'] = $comprimentoTotalIndividual;
            $produtosCarrinho[$index]['pesoTotalProduto'] = $pesoTotalIndividual;

            $precoSubTotal += $produtosCarrinho[$index]['valorProduto'];
            $precoTotal += $produtosCarrinho[$index]['valorProduto'];

            session([ 'totalHeight' => $alturaTotal ]);
            session([ 'totalWidth' => $larguraTotal ]);
            session([ 'totalLength' => $comprimentoTotal ]);
            session([ 'totalWeight' => $pesoTotal ]);

            session([ 'subtotalPrice' => $precoSubTotal ]);
            session([ 'totalPrice' => $precoTotal ]);

            session([ 'qtCart' => $qtdProdutosCarrinho ]);
            session([ 'cart' => $produtosCarrinho ]);

        //dd(Session::get('cart'));
        } else {
            if (Session::get('qtCart') == 0) {
                Session::put('cart', []);

                $qtdProdutosCarrinho = Session::get('qtCart');
                
                $index = 0;
                $qtdItensCarrinho = 1;

                $alturaTotal = 0;
                $larguraTotal = 0;
                $comprimentoTotal = 0;
                $pesoTotal = 0;

                $precoSubTotal = 0;
                $precoTotal = 0;

                $produtosCarrinho = [
                    'codProduto' => $request->cd_produto,
                    'nomeProduto' => $request->nm_produto,
                    'skuProduto' => $request->sku_produto,
                    'descricaoProduto' => $request->ds_produto,
                    'valorProduto' => $request->vl_produto,
                    'qtdProdutoEstoque' => $request->qt_produto,
                    'qtdIndividual' => 1,
                    'imagemProduto' => $request->im_produto,
                    'pesoProduto' => $request->ds_peso,
                    'pesoTotalProduto' => $request->ds_peso,
                    'alturaProduto' => $request->ds_altura,
                    'alturaTotalProduto' => $request->ds_altura,
                    'larguraProduto' => $request->ds_largura,
                    'larguraTotalProduto' => $request->ds_largura,
                    'comprimentoProduto' => $request->ds_comprimento,
                    'comprimentoTotalProduto' => $request->ds_comprimento,
                    'valorTotalProduto' => $request->vl_produto
                ];

                Session::push('cart', $produtosCarrinho);

                $precoSubTotal += $request->vl_produto;
                $alturaTotal += $request->ds_altura;
                $larguraTotal += $request->ds_largura;
                $comprimentoTotal += $request->ds_comprimento;
                $pesoTotal += $request->ds_peso;
                $precoTotal += $request->vl_produto;

                Session::put('totalHeight', $alturaTotal);
                Session::put('totalWidth', $larguraTotal);
                Session::put('totalLength', $comprimentoTotal);
                Session::put('totalWeight', $pesoTotal);

                Session::put('subtotalPrice', $precoSubTotal);
                Session::put('totalPrice', $precoTotal);
                
                Session::put('idx' . $request->sku_produto, $index);
                Session::put('qtCartItems', $qtdItensCarrinho);

                $qtdProdutosCarrinho++;

                Session::put('qtCart', $qtdProdutosCarrinho);
            } else {
                $qtdProdutosCarrinho = intval(Session::get('qtCart'));

                $qtdItensCarrinho = intval(Session::get('qtCartItems'));
                $index = Session::get('idx' . $request->sku_produto);

                $alturaTotal = Session::get('totalHeight');
                $larguraTotal = Session::get('totalWidth');
                $comprimentoTotal = Session::get('totalLength');
                $pesoTotal = Session::get('totalWeight');

                $precoSubTotal = Session::get('subtotalPrice');
                $precoTotal = Session::get('totalPrice');

                //dd($produtosCarrinho);

                $produtosCarrinho = [
                    'codProduto' => $request->cd_produto,
                    'nomeProduto' => $request->nm_produto,
                    'skuProduto' => $request->sku_produto,
                    'descricaoProduto' => $request->ds_produto,
                    'valorProduto' => $request->vl_produto,
                    'qtdProdutoEstoque' => $request->qt_produto,
                    'qtdIndividual' => 1,
                    'imagemProduto' => $request->im_produto,
                    'pesoProduto' => $request->ds_peso,
                    'pesoTotalProduto' => $request->ds_peso,
                    'alturaProduto' => $request->ds_altura,
                    'alturaTotalProduto' => $request->ds_altura,
                    'larguraProduto' => $request->ds_largura,
                    'larguraTotalProduto' => $request->ds_largura,
                    'comprimentoProduto' => $request->ds_comprimento,
                    'comprimentoTotalProduto' => $request->ds_comprimento,
                    'valorTotalProduto' => $request->vl_produto
                ];

                Session::push('cart', $produtosCarrinho);

                $precoSubTotal += $request->vl_produto;
                $precoTotal += $request->vl_produto;
                $alturaTotal += $request->ds_altura;
                $larguraTotal += $request->ds_largura;
                $comprimentoTotal += $request->ds_comprimento;
                $pesoTotal += $request->ds_peso;

                //dd($produtosCarrinho);

                $qtdProdutosCarrinho++;
                $qtdItensCarrinho++;
                $index++;

                session([ 'totalHeight' => $alturaTotal ]);
                session([ 'totalWidth' => $larguraTotal ]);
                session([ 'totalLength' => $comprimentoTotal ]);
                session([ 'totalWeight' => $pesoTotal ]);

                session([ 'subtotalPrice' => $precoSubTotal ]);
                session([ 'totalPrice' => $precoTotal ]);

                session([ 'qtCart' => $qtdProdutosCarrinho ]);
                session([ 'qtCartItems' => $qtdItensCarrinho ]);
                session([ 'idx' . $request->sku_produto => $index ]);
            }
        }

        return redirect()->route('cart.page')->with('success', 'Item adicionado ao carrinho');
    }

    public function verificaProduto($skuProduto)
    {
        if (Session::has('cart')) {
            $carrinho = Session::get('cart');

            foreach ($carrinho as $key => $item) {
                if ($item['skuProduto'] == $skuProduto) {
                    return true;
                }
            }
        }

        return false;
    }

    public function finalizarCompra(Request $request)
    {
        //dd($request->all());

        $ddd = substr($request->telefone, 0, 2);
        $telefone = substr($request->telefone, 2);

        if ($request->complemento_endereco == null) {
            $complemento = '';
        } else {
            $complemento = $request->complemento_endereco;
        }

        $data['token'] = '98911E4EC1494B7A8C3E8E7C4AD9F181';
        $data['email'] = 'manoel@manoelcastro.com.br';
        $data['currency'] = 'BRL';

        foreach ($request->largura as $key => $l) {
            if ($l < 11) {
                $larguras[$key] = '11';
            } else {
                $larguras[$key] = $l;
            }
        }

        foreach ($request->altura as $key => $a) {
            if ($a < 2) {
                $alturas[$key] = '2';
            } else {
                $alturas[$key] = $a;
            }
        }

        foreach ($request->comprimento as $key => $c) {
            if ($c < 16) {
                $comprimentos[$key] = '16';
            } else {
                $comprimentos[$key] = $c;
            }
        }

        foreach ($request->peso as $key => $p) {
            $pesos[$key] = $p;
        }

        // foreach ($alt as $key => $a) {
        //     //dd($a);

        //     if (doubleval($a) < 2) {
        //         $alturas[$key] = 2;
        //     } else {
        //         $alturas[$key] = doubleval($a) * $qtd;
        //     }
        // }

        //dd($alturas);

        // foreach ($comp as $key => $c) {
        //     if ($c < 16) {
        //         $comprimentos[$key] = 16;
        //     } else {
        //         $comprimentos[$key] = doubleval($c) * $qtd;
        //     }
        // }
        
        // dd($comprimentos);

        // foreach ($pes as $key => $p) {
        //     $pesos[$key] = doubleval($p) * $qtd;
        // }

        foreach ($request->id as $key => $id) {
            $data['itemId'.($key + 1)] = $id;
        }

        foreach ($request->quantidade as $key => $qtd) {
            $data['itemQuantity'.($key + 1)] = $qtd;
        }

        foreach ($request->descricao as $key => $desc) {
            $data['itemDescription'.($key + 1)] = $desc;
        }
        
        foreach ($request->valor as $key => $val) {
            $data['itemAmount'.($key + 1)] = $val;
        }

        foreach ($pesos as $key => $p) {
            $data['itemWeight'.($key + 1)] = intval($p);
        }
        
        foreach ($larguras as $key => $l) {
            $data['itemWidth'.($key + 1)] = $l;
        }
        
        foreach ($alturas as $key => $a) {
            $data['itemHeight'.($key + 1)] = $a;
        }
        
        foreach ($comprimentos as $key => $c) {
            $data['itemLength'.($key + 1)] = $c;
        }

        $data['shippingType'] = $request->tipoServ;
        $data['shippingCost'] = $request->freteval;
        $data['shippingAddressPostalCode'] = $request->cep;
        $data['shippingAddressStreet'] = $request->endereco;
        $data['shippingAddressNumber'] = $request->numero_endereco;
        $data['shippingAddressComplement'] = $complemento;
        $data['shippingAddressDistrict'] = $request->bairro;
        $data['shippingAddressCity'] = $request->cidade;
        $data['shippingAddressState'] = $request->estado;
        $data['shippingAddressCountry'] = $request->pais;
        $data['senderName'] = $request->nome;
        $data['senderCPF'] = $request->numero_cpf;
        $data['senderAreaCode'] = $ddd;
        $data['senderPhone'] = $telefone;
        $data['senderEmail'] = $request->email_cliente;
        $data['redirectURL'] = route('cart.result.page');

        //dd($data);

        $url = 'https://ws.pagseguro.uol.com.br/v2/checkout';

        $data = http_build_query($data);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml = curl_exec($curl);

        //dd($xml);

        curl_close($curl);

        $xml = simplexml_load_string($xml);

        return response()->json(['codigoCompra' => $xml->code]);
        
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

    public function deleteProduct(Request $request)
    {
        //dd($request->all());

        $carrinho = Session::get('cart');
        $qtdCarrinho = Session::get('qtCart');
        $qtdItensCarrinho = Session::get('qtCartItems');

        $precoSubTotal = Session::get('subtotalPrice');

        $alturaTotal = Session::get('totalHeight');
        $alturaTotalIndividual = $carrinho[$request->cod_produto_carrinho]['alturaTotalProduto'];

        $larguraTotal = Session::get('totalWidth');
        $larguraTotalIndividual = $carrinho[$request->cod_produto_carrinho]['larguraTotalProduto'];

        $comprimentoTotal = Session::get('totalLength');
        $comprimentoTotalIndividual = $carrinho[$request->cod_produto_carrinho]['comprimentoTotalProduto'];

        $pesoTotal = Session::get('totalWeight');
        $pesoTotalIndividual = $carrinho[$request->cod_produto_carrinho]['pesoTotalProduto'];

        //dd($qtdCarrinho);

        $qtdProdExcluido = $carrinho[$request->cod_produto_carrinho]['qtdIndividual'];

        $valorTotalProdExcluido = $carrinho[$request->cod_produto_carrinho]['valorTotalProduto'];

        $precoSubTotal -= $valorTotalProdExcluido;

        //dd($qtdProdExcluido);

        $qtdCarrinho -= $qtdProdExcluido;

        $alturaTotal -= $alturaTotalIndividual;
        $larguraTotal -= $larguraTotalIndividual;
        $comprimentoTotal -= $comprimentoTotalIndividual;
        $pesoTotal -= $pesoTotalIndividual;

        $qtdItensCarrinho--;

        unset($carrinho[$request->cod_produto_carrinho]);

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCarrinho ]);
        session([ 'qtCartItens' => $qtdItensCarrinho ]);

        session([ 'totalHeight' => $alturaTotal ]);
        session([ 'totalWidth' => $larguraTotal ]);
        session([ 'totalLength' => $comprimentoTotal ]);
        session([ 'totalWeight' => $pesoTotal ]);

        session([ 'subtotalPrice' => $precoSubTotal ]);

        return redirect()->route('cart.page')->with('success', 'Item excluído com sucesso');
    }

    public function clearCart(Request $request)
    {
        foreach ($request->idx as $key => $sku) {
            Session::forget('idx' . $sku);
        }

        Session::forget('cart');
        Session::forget('qtCart');
        Session::forget('qtCartItens');

        Session::forget('totalHeight');
        Session::forget('totalWidth');
        Session::forget('totalLength');
        Session::forget('totalWeight');

        Session::forget('subtotalPrice');

        return redirect()->route('cart.page')->with('success', 'Itens excluídos do carrinho');
    }

    public function addQuantityCart($idx)
    {
        $carrinho = Session::get('cart');
        $qtdCart = Session::get('qtCart');

        $precoSubTotal = Session::get('subtotalPrice');
        $precoTotal = Session::get('totalPrice');

        $alturaTotal = Session::get('totalHeight');
        $alturaTotalIndividual = $carrinho[$idx]['alturaTotalProduto'];

        $larguraTotal = Session::get('totalWidth');
        $larguraTotalIndividual = $carrinho[$idx]['larguraTotalProduto'];

        $comprimentoTotal = Session::get('totalLength');
        $comprimentoTotalIndividual = $carrinho[$idx]['comprimentoTotalProduto'];

        $pesoTotal = Session::get('totalWeight');
        $pesoTotalIndividual = $carrinho[$idx]['pesoTotalProduto'];

        $qtInd = $carrinho[$idx]['qtdIndividual'];
        $vlProd = $carrinho[$idx]['valorProduto'];

        $alturaTotal += $carrinho[$idx]['alturaProduto'];
        $alturaTotalIndividual += $carrinho[$idx]['alturaProduto'];

        $larguraTotal += $carrinho[$idx]['larguraProduto'];
        $larguraTotalIndividual += $carrinho[$idx]['larguraProduto'];

        $comprimentoTotal += $carrinho[$idx]['comprimentoProduto'];
        $comprimentoTotalIndividual += $carrinho[$idx]['comprimentoProduto'];

        $pesoTotal += $carrinho[$idx]['pesoProduto'];
        $pesoTotalIndividual += $carrinho[$idx]['pesoProduto'];

        $qtInd += 1;

        $carrinho[$idx]['qtdIndividual'] = $qtInd;

        $carrinho[$idx]['alturaTotalProduto'] = $alturaTotalIndividual;
        $carrinho[$idx]['larguraTotalProduto'] = $larguraTotalIndividual;
        $carrinho[$idx]['comprimentoTotalProduto'] = $comprimentoTotalIndividual;
        $carrinho[$idx]['pesoTotalProduto'] = $pesoTotalIndividual;
 
        $vTotal = $vlProd * $qtInd;

        $precoSubTotal += $vlProd;
        $precoTotal += $vlProd;

        $carrinho[$idx]['valorTotalProduto'] = $vTotal;
        $qtdCart += 1;

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCart ]);

        session([ 'totalHeight' => $alturaTotal ]);
        session([ 'totalWidth' => $larguraTotal ]);
        session([ 'totalLength' => $comprimentoTotal ]);
        session([ 'totalWeight' => $pesoTotal ]);

        session([ 'subtotalPrice' => $precoSubTotal ]);
        session([ 'totalPrice' => $precoTotal ]);

        return response([
                'cartSession' => Session::get('cart'),
                'qtCarrinho' => Session::get('qtCart'),
                'qtProdEstoque' => $carrinho[$idx]['qtdProdutoEstoque'],
                'subTotal' => Session::get('subtotalPrice'),
                'total' => Session::get('totalPrice')
            ]);
    }

    public function removeQuantityCart($idx)
    {
        $carrinho = Session::get('cart');
        $qtdCart = Session::get('qtCart');

        $precoSubTotal = Session::get('subtotalPrice');
        $precoTotal = Session::get('totalPrice');

        $alturaTotal = Session::get('totalHeight');
        $alturaTotalIndividual = $carrinho[$idx]['alturaTotalProduto'];

        $larguraTotal = Session::get('totalWidth');
        $larguraTotalIndividual = $carrinho[$idx]['larguraTotalProduto'];

        $comprimentoTotal = Session::get('totalLength');
        $comprimentoTotalIndividual = $carrinho[$idx]['comprimentoTotalProduto'];

        $pesoTotal = Session::get('totalWeight');
        $pesoTotalIndividual = $carrinho[$idx]['pesoTotalProduto'];

        $qtInd = $carrinho[$idx]['qtdIndividual'];
        $vlProd = $carrinho[$idx]['valorProduto'];

        $alturaTotal -= $carrinho[$idx]['alturaProduto'];
        $alturaTotalIndividual -= $carrinho[$idx]['alturaProduto'];

        $larguraTotal -= $carrinho[$idx]['larguraProduto'];
        $larguraTotalIndividual -= $carrinho[$idx]['larguraProduto'];

        $comprimentoTotal -= $carrinho[$idx]['comprimentoProduto'];
        $comprimentoTotalIndividual -= $carrinho[$idx]['comprimentoProduto'];

        $pesoTotal -= $carrinho[$idx]['pesoProduto'];
        $pesoTotalIndividual -= $carrinho[$idx]['pesoProduto'];

        $qtInd -= 1;

        $carrinho[$idx]['qtdIndividual'] = $qtInd;
        
        $vTotal = $vlProd * $qtInd;

        $precoSubTotal -= $vlProd;
        $precoTotal -= $vlProd;


        $carrinho[$idx]['valorTotalProduto'] = $vTotal;
        $qtdCart -= 1;

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCart ]);

        session([ 'totalHeight' => $alturaTotal ]);
        session([ 'totalWidth' => $larguraTotal ]);
        session([ 'totalLength' => $comprimentoTotal ]);
        session([ 'totalWeight' => $pesoTotal ]);

        session([ 'subtotalPrice' => $precoSubTotal ]);
        session([ 'totalPrice' => $precoTotal ]);

        return response([
            'cartSession' => Session::get('cart'),
            'qtCarrinho' => Session::get('qtCart'),
            'qtProdEstoque' => $carrinho[$idx]['qtdProdutoEstoque'],
            'subTotal' => Session::get('subtotalPrice'),
            'total' => Session::get('totalPrice')
        ]);
    }
}
