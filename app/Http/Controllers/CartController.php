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
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function showCartPage()
    {
        return view('pages.app.carrinho');
    }

    public function cart2()
    {
        return view('pages.app.carrinho');
    }

    public function teste()
    {
        //dd($carrinho);

        //$produto = Product::join('sku', 'produto.cd_sku', 'sku.cd_sku')->join('dimensao', 'dimensao.cd_dimensao', 'sku.cd_dimensao')->where('produto.cd_produto', '=', $cd_produto)->get();

        //$p = Session::get('produtos');

        $produtos = Session::get('carrinho');

        dd($produtos);

        //$produto = Product::join('sku', 'produto.cd_sku', 'sku.cd_sku')->where('produto.cd_produto', '=', $cd_produto)->get();

        foreach ($produtos as $key => $produto) {
            $imagem = Product::join('sku', 'produto.cd_sku', 'sku.cd_sku')->join('sku_produto_img', 'sku_produto_img.cd_sku', 'sku.cd_sku')->join('img_produto', 'sku_produto_img.cd_img', 'img_produto.cd_img')->select('im_produto')->where('produto.cd_produto', '=', $produto['codProduto'])->get()->toArray();
        }

        $arr = array_combine($produtos, $imagem);

        dd($arr);

        $cliente = Auth::user();

        //dd($cliente);
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

    public function store(Request $request)
    {
        //dd($request->all());

        Cart::add($request->sku_produto, $request->nm_poduto, $request->qtd_produto, $request->vl_produto);

        return redirect()->route('cart.page')->with('success', 'Item adicionado ao carrinho');
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

            session([ 'qtCart' => $qtdProdutosCarrinho ]);
            session([ 'cart' => $produtosCarrinho ]);

        //dd(Session::get('cart'));
        } else {
            if (Session::get('qtCart') == 0) {
                Session::put('cart', []);

                $qtdProdutosCarrinho = Session::get('qtCart');
                
                $index = 0;

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
                    'alturaProduto' => $request->ds_altura,
                    'larguraProduto' => $request->ds_largura,
                    'comprimentoProduto' => $request->ds_comprimento,
                    'valorTotalProduto' => $request->vl_produto
                ];

                Session::push('cart', $produtosCarrinho);
                Session::put('idx' . $request->sku_produto, $index);

                $qtdProdutosCarrinho++;

                Session::put('qtCart', $qtdProdutosCarrinho);
            } else {
                $qtdProdutosCarrinho = intval(Session::get('qtCart'));

                $index = Session::get('idx' . $request->sku_produto);

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
                    'alturaProduto' => $request->ds_altura,
                    'larguraProduto' => $request->ds_largura,
                    'comprimentoProduto' => $request->ds_comprimento,
                    'valorTotalProduto' => $request->vl_produto
                ];

                Session::push('cart', $produtosCarrinho);

                //dd($produtosCarrinho);

                $qtdProdutosCarrinho++;
                $index++;

                session([ 'qtCart' => $qtdProdutosCarrinho ]);
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

        $largura = $request->largura;
        $altura = $request->altura;
        $comprimento = $request->comprimento;

        if ($largura < 11) {
            $largura = 11;
        }
        if ($altura < 2) {
            $altura = 2;
        }
        if ($comprimento < 16) {
            $comprimento = 16;
        }

        $data['token'] = '98911E4EC1494B7A8C3E8E7C4AD9F181';
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
        $xml = curl_exec($curl);

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

        //dd($qtdCarrinho);

        $qtdProdExcluido = $carrinho[$request->cod_produto_carrinho]['qtdIndividual'];

        //dd($qtdProdExcluido);

        $qtdCarrinho -= $qtdProdExcluido;

        unset($carrinho[$request->cod_produto_carrinho]);

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCarrinho ]);

        return redirect()->route('cart.page')->with('success', 'Item excluído com sucesso');
    }

    public function clearCart(Request $request)
    {
        foreach ($request->idx as $key => $sku) {
            Session::forget('idx' . $sku);
        }

        Session::forget('cart');
        Session::forget('qtCart');

        return redirect()->route('cart.page')->with('success', 'Itens excluídos do carrinho');
    }

    public function addQuantityCart($idx)
    {
        $carrinho = Session::get('cart');
        $qtdCart = Session::get('qtCart');

        $qtInd = $carrinho[$idx]['qtdIndividual'];
        $vlProd = $carrinho[$idx]['valorProduto'];

        $qtInd += 1;

        $carrinho[$idx]['qtdIndividual'] = $qtInd;
            
        $vTotal = $vlProd * $qtInd;

        $carrinho[$idx]['valorTotalProduto'] = $vTotal;
        $qtdCart += 1;

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCart ]);

        return response([
                'cartSession' => Session::get('cart'),
                'qtCarrinho' => Session::get('qtCart'),
                'qtProdEstoque' => $carrinho[$idx]['qtdProdutoEstoque']
            ]);
    }

    public function removeQuantityCart($idx)
    {
        $carrinho = Session::get('cart');
        $qtdCart = Session::get('qtCart');

        $qtInd = $carrinho[$idx]['qtdIndividual'];
        $vlProd = $carrinho[$idx]['valorProduto'];

        $qtInd -= 1;

        $carrinho[$idx]['qtdIndividual'] = $qtInd;
        
        $vTotal = $vlProd * $qtInd;

        $carrinho[$idx]['valorTotalProduto'] = $vTotal;
        $qtdCart -= 1;

        session([ 'cart' => $carrinho ]);
        session([ 'qtCart' => $qtdCart ]);

        return response([
            'cartSession' => Session::get('cart'),
            'qtCarrinho' => Session::get('qtCart')
        ]);
    }
}
