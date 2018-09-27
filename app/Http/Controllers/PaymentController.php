<?php

namespace App\Http\Controllers;

use App\Category;
use App\Menu;
use App\NavigationMenu;
use App\Sku;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Phone;
use App\Client as Cli;
use App\Order;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    //GERA ID DO VENDEDOR
    public function showSalesman()
    {
        $idSalesman = '';
        $cnpj = '' ;
        $dadosCompany = $this->getCompanyData();
        $names = explode(' ', $dadosCompany[0]->nm_razao_social);
        foreach ($names as $name) {
            $idSalesman .= substr($name, 0, 1);
        }
        $cnpj = $dadosCompany[0]->cd_cnpj;
        $cnpj = substr($cnpj, 12, 2);
        $idSalesman = $idSalesman.$cnpj.'-';
        return $idSalesman;
    }

    public function showCheckoutPage()
    {
        $cart = Session::get('cart');

        if ($cart == null) {
            return redirect()->route('cart.page');
        }

        $months = [];
        $years = [];
        $initialYear = Carbon::now()->year;

        if (Auth::check()) {
            for ($i=0; $i < 12; $i++) {
                $months[$i] = ($i + 1);
            }

            for ($j=0; $j < 15; $j++) {
                $years[$j] = $initialYear++;
            }

            $menuNav =  Menu::all();

            $menuNavegacao = NavigationMenu::all();
            //dd($menuNavegacao[0]->menu_ativo);



            if (count($menuNavegacao) > 0) {
                if ($menuNavegacao[0]->menu_ativo == 1) {
                    //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                    foreach ($menuNav as $key => $menu) {
                        $categoriaSubCat[$key] = Category::
                        leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                            ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                            ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                            ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                            ->select(
                                'categoria.cd_categoria',
                                'categoria.nm_categoria',
                                'sub_categoria.cd_sub_categoria',
                                'sub_categoria.nm_sub_categoria'
                            )
                            ->where('menu.cd_menu', '=', $menu->cd_menu)
                            ->get();
                    }
                } else {
                    $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                        ->select(
                            'categoria.cd_categoria',
                            'categoria.nm_categoria',
                            'sub_categoria.cd_sub_categoria',
                            'sub_categoria.nm_sub_categoria'
                        )
                        ->orderBy('ordem_categoria.cd_ordem_categoria')
                        ->get();
                }
            }

            return view('pages.app.cart.checkout', compact('months', 'years', 'menuNav', 'menuNavegacao', 'categoriaSubCat'));
        }

        Session::put('cartRoute', 'cart.page');

        Session::save();

        return redirect()->route('client.login');
    }

    public function showOrderDetailsPage()
    {
        $cart = Session::get('cart');
        $shippingData = Session::get('shippingData');
        $creditCardInfo = Session::get('creditCardInfo');

        if ($cart == null) {
            return redirect()->route('cart.page');
        } else {
            if (\Route::current()->getName() == 'payment.order.ticket.details') {
                $paymentType = 'boleto';
            } else {
                $paymentType = 'cartao';
            }
        }

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);

        if (count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
                    $categoriaSubCat[$key] = Category::
                    leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                        ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                        ->select(
                            'categoria.cd_categoria',
                            'categoria.nm_categoria',
                            'sub_categoria.cd_sub_categoria',
                            'sub_categoria.nm_sub_categoria'
                        )
                        ->where('menu.cd_menu', '=', $menu->cd_menu)
                        ->get();
                }
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
        }

        return view('pages.app.cart.orderdetails', compact('cart', 'shippingData', 'creditCardInfo', 'paymentType', 'menuNav', 'menuNavegacao', 'categoriaSubCat'));
    }

    public function showResultPage()
    {
        $cart = Session::get('cart');
        $orderData = Session::get('orderData');

        if ($cart == null) {
            return redirect()->route('cart.page');
        }

        $menuNav =  Menu::all();

        $menuNavegacao = NavigationMenu::all();
        //dd($menuNavegacao[0]->menu_ativo);

        if (count($menuNavegacao) > 0) {
            if ($menuNavegacao[0]->menu_ativo == 1) {
                //Carrega as categorias e subcategorias para serem apresentadas no menu nav
                foreach ($menuNav as $key => $menu) {
                    $categoriaSubCat[$key] = Category::
                    leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                        ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                        ->leftJoin('menu_categoria', 'menu_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                        ->leftJoin('menu', 'menu.cd_menu', '=', 'menu_categoria.fk_cd_menu')
                        ->select(
                            'categoria.cd_categoria',
                            'categoria.nm_categoria',
                            'sub_categoria.cd_sub_categoria',
                            'sub_categoria.nm_sub_categoria'
                        )
                        ->where('menu.cd_menu', '=', $menu->cd_menu)
                        ->get();
                }
            } else {
                $categoriaSubCat = Category::leftJoin('categoria_subcat', 'categoria.cd_categoria', '=', 'categoria_subcat.cd_categoria')
                    ->leftJoin('sub_categoria', 'sub_categoria.cd_sub_categoria', '=', 'categoria_subcat.cd_sub_categoria')
                    ->join('ordem_categoria', 'ordem_categoria.fk_cd_categoria', '=', 'categoria.cd_categoria')
                    ->select(
                        'categoria.cd_categoria',
                        'categoria.nm_categoria',
                        'sub_categoria.cd_sub_categoria',
                        'sub_categoria.nm_sub_categoria'
                    )
                    ->orderBy('ordem_categoria.cd_ordem_categoria')
                    ->get();
            }
        }

        $this->clearCart();

        return view('pages.app.cart.result', compact('orderData', 'menuNav', 'menuNavegacao', 'categoriaSubCat'));
    }

    public function createSessionId(Request $request)
    {
        $data['token'] ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        
        $data = http_build_query($data);
        //dd($data);
        $url = 'https://ws.pagseguro.uol.com.br/v2/sessions/';
        
        $curl = curl_init();

        $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

        curl_setopt($curl, CURLOPT_URL, $url . '?email=' . $emailPagseguro);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $xml = curl_exec($curl);

        curl_close($curl);

        //dd($xml);

        $xml = simplexml_load_string($xml);
        $idSessao = $xml->id;
        //dd($xml);
        
        $response = [ 'idSessao' => $idSessao];

        return response()->json($response);
    }

    public function ticketPayment(Request $request)
    {

        //dd(Session::get('cepPrincipal'));

        $pagSeguroData = [];
        $cartProducts = Session::get('cart');
        //dd($cartProducts);
        $shippingData = Session::get('shippingData');

        if (Session::has('orderData')) {
            Session::forget('orderData');
        }

        Session::put('orderData', []);

        $pagSeguroData['token'] ='4D97A178277542CAAB150D1096002DF1';
        $pagSeguroData['email'] = 'vendas@vipx.com.br';

        $pagSeguroData['paymentMode'] = 'default';
        $pagSeguroData['paymentMethod'] = 'boleto';
        $pagSeguroData['currency'] = 'BRL';

        foreach ($cartProducts as $key => $product) {
            $pagSeguroData['itemId' . ($key + 1)] = strval(($key + 1));
            $pagSeguroData['itemDescription' . ($key + 1)] = $product['nomeProduto'];
            $pagSeguroData['itemAmount' . ($key + 1)] = strval(number_format($product['valorProduto'], 2, '.', ''));
            $pagSeguroData['itemQuantity' . ($key + 1)] = strval($product['qtdIndividual']);
        }

        //HASH DE PAGAMENTO
        $pagSeguroData['notificationURL'] = '';
        $pagSeguroData['reference'] = uniqid($this->showSalesman(), true);

        $pagSeguroData['notificationURL'] = '';
        $pagSeguroData['reference'] = uniqid($this->showSalesman(), true);

        $clientData = $this->getClientData($request->cd_cliente);

        $fk_endereco = $clientData[0]['id_cliente_endereco'];
        //dd($clientData);

        $pagSeguroData['senderName'] = $clientData[0]['nm_cliente'];
        $pagSeguroData['senderCPF'] = $clientData[0]['cd_cpf_cnpj'];

        $senderAreaCode = substr($clientData[0]['cd_celular1'], 0, 2);
        $senderPhone = substr($clientData[0]['cd_celular1'], 2);

        $pagSeguroData['senderAreaCode'] = $senderAreaCode;
        $pagSeguroData['senderPhone'] = $senderPhone;
        $pagSeguroData['senderEmail'] = $clientData[0]['email'];
        $pagSeguroData['senderHash'] = $request->senderHash;

        $pagSeguroData['shippingAddressStreet'] = $clientData[0]['ds_endereco'];
        $pagSeguroData['shippingAddressNumber'] = strval($clientData[0]['cd_numero_endereco']);
        $pagSeguroData['shippingAddressComplement'] = $clientData[0]['ds_complemento'];
        $pagSeguroData['shippingAddressDistrict'] = $clientData[0]['nm_bairro'];
        $pagSeguroData['shippingAddressPostalCode'] = strval($clientData[0]['cd_cep']);
        $pagSeguroData['shippingAddressCity'] = $clientData[0]['nm_cidade'];
        $pagSeguroData['shippingAddressState'] = $clientData[0]['sg_uf'];
        $pagSeguroData['shippingAddressCountry'] = 'BRA';
        $pagSeguroData['shippingType'] = $shippingData[0]['tipo'];
        $pagSeguroData['shippingCost'] = $shippingData[0]['valor'];

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/';

        $data = http_build_query($pagSeguroData);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml = curl_exec($curl);

        curl_close($curl);

        //dd($xml);
        $xml = simplexml_load_string($xml);

        //dd($xml);
        $orderDay = explode('T', strval($xml->date));

        $orderData = [
            'codigo' => strval($xml->code),
            'referencia' => strval($xml->reference),
            'dataCompra' => $orderDay[0],
            'tipoPagamento' => 'boleto',
            'statusCompra' => strval($xml->status),
            'linkBoleto' => strval($xml->paymentLink),
            'valorTotal' => strval($xml->grossAmount),
            'valorFrete' => strval($xml->shipping->cost)
        ];

        if (strval($xml->shipping->type) == '1') {
            $orderData['tipoFrete'] = 'Pac';
        }
        else if (strval($xml->shipping->type) == '2') {
            $orderData['tipoFrete'] = 'Sedex';
        }
        else{
            $orderData['tipoFrete'] = 'Entrega Vip-X';
        }

        Session::push('orderData', $orderData);

        Session::save();

        DB::beginTransaction();

        try {
            $order = $this->saveOrder($orderData['valorTotal'], $orderData['statusCompra'], $orderData['referencia'],
                $orderData['codigo'], $orderData['dataCompra'], $orderData['valorFrete'], $request->cd_cliente,
                $fk_endereco, strval($xml->shipping->type), 1, $orderData['valorTotal']);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Order');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Order');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Erro ao conectar com o banco de dados - Order');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            foreach ($cartProducts as $key => $product) {
                $sku = Sku::where('cd_nr_sku', '=', $product['skuProduto'])->get();
                $this->saveOrderItem($order->cd_pedido, $sku[0]->cd_sku, 1, $product['qtdIndividual']);
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Item');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Item');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Erro ao conectar com o banco de dados - Item');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('payment.result');
    }

    public function creditCardPayment(Request $request)
    {
        $pagSeguroData = [];
        $cartProducts = Session::get('cart');
        $shippingData = Session::get('shippingData');
        $cardInfo = Session::get('creditCardInfo');

        if (Session::has('orderData')) {
            Session::forget('orderData');
        }

        Session::put('orderData', []);

        $pagSeguroData['token'] ='4D97A178277542CAAB150D1096002DF1';
        $pagSeguroData['email'] = 'vendas@vipx.com.br';

        $pagSeguroData['paymentMode'] = 'default';
        $pagSeguroData['paymentMethod'] = 'creditCard';
        $pagSeguroData['currency'] = 'BRL';

        foreach ($cartProducts as $key => $product) {
            $pagSeguroData['itemId' . ($key + 1)] = strval(($key + 1));
            $pagSeguroData['itemDescription' . ($key + 1)] = $product['nomeProduto'];
            $pagSeguroData['itemAmount' . ($key + 1)] = strval(number_format($product['valorProduto'], 2, '.', ''));
            $pagSeguroData['itemQuantity' . ($key + 1)] = strval($product['qtdIndividual']);
        }

        $pagSeguroData['notificationURL'] = '';
        $pagSeguroData['reference'] = uniqid($this->showSalesman(), true);

        $clientData = $this->getClientData($request->cd_cliente);

        $fk_endereco = $clientData[0]['id_cliente_endereco'];

        //dd($fk_endereco);

        $pagSeguroData['senderName'] = $clientData[0]['nm_cliente'];
        $pagSeguroData['senderCPF'] = $clientData[0]['cd_cpf_cnpj'];

        $senderAreaCode = substr($clientData[0]['cd_celular1'], 0, 2);
        $senderPhone = substr($clientData[0]['cd_celular1'], 2);

        $pagSeguroData['senderAreaCode'] = $senderAreaCode;
        $pagSeguroData['senderPhone'] = $senderPhone;
        $pagSeguroData['senderEmail'] = $clientData[0]['email'];
        $pagSeguroData['senderHash'] = $request->senderHash;

        $pagSeguroData['shippingAddressStreet'] = $clientData[0]['ds_endereco'];
        $pagSeguroData['shippingAddressNumber'] = strval($clientData[0]['cd_numero_endereco']);
        $pagSeguroData['shippingAddressComplement'] = $clientData[0]['ds_complemento'];
        $pagSeguroData['shippingAddressDistrict'] = $clientData[0]['nm_bairro'];
        $pagSeguroData['shippingAddressPostalCode'] = strval($clientData[0]['cd_cep']);
        $pagSeguroData['shippingAddressCity'] = $clientData[0]['nm_cidade'];
        $pagSeguroData['shippingAddressState'] = $clientData[0]['sg_uf'];
        $pagSeguroData['shippingAddressCountry'] = 'BRA';
        $pagSeguroData['shippingType'] = $shippingData[0]['tipo'];
        $pagSeguroData['shippingCost'] = $shippingData[0]['valor'];

        $pagSeguroData['creditCardToken'] = strval($request->cardToken);
        $pagSeguroData['installmentQuantity'] = strval($cardInfo[0]['installmentQuantity']);
        $pagSeguroData['installmentValue'] = strval(number_format($cardInfo[0]['installmentAmount'], 2, '.', ''));
        $pagSeguroData['noInterestInstallmentQuantity'] = 3;

        $pagSeguroData['creditCardHolderName'] = $clientData[0]['nm_cliente'];
        $pagSeguroData['creditCardHolderCPF'] = $clientData[0]['cd_cpf_cnpj'];
        $pagSeguroData['creditCardHolderBirthDate'] = '15/04/1984';
        $pagSeguroData['creditCardHolderAreaCode'] = $senderAreaCode;
        $pagSeguroData['creditCardHolderPhone'] = $senderPhone;
        $pagSeguroData['billingAddressStreet'] = $clientData[0]['ds_endereco'];
        $pagSeguroData['billingAddressNumber'] = strval($clientData[0]['cd_numero_endereco']);
        $pagSeguroData['billingAddressComplement'] = $clientData[0]['ds_complemento'];
        $pagSeguroData['billingAddressDistrict'] = $clientData[0]['nm_bairro'];
        $pagSeguroData['billingAddressPostalCode'] = strval($clientData[0]['cd_cep']);
        $pagSeguroData['billingAddressCity'] = $clientData[0]['nm_cidade'];
        $pagSeguroData['billingAddressState'] = $clientData[0]['sg_uf'];
        $pagSeguroData['billingAddressCountry'] = 'BRA';

        $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/';

        $data = http_build_query($pagSeguroData);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $xml = curl_exec($curl);

        curl_close($curl);

        $xml = simplexml_load_string($xml);

        //dd($xml);
        $orderDay = explode('T', strval($xml->date));

        $orderData = [
            'codigo' => strval($xml->code),
            'referencia' => strval($xml->reference),
            'dataCompra' => $orderDay[0],
            'statusCompra' => strval($xml->status),
            'tipoPagamento' => 'cartao',
            'valorTotal' => strval($xml->grossAmount),
            'valorFrete' => strval($xml->shipping->cost)
        ];

        if (strval($xml->shipping->type) == '1') {
            $orderData['tipoFrete'] = 'Pac';
        } else if (strval($xml->shipping->type) == '2') {
            $orderData['tipoFrete'] = 'Sedex';
        }
        else{
            $orderData['tipoFrete'] = 'Entrega Vip-X';
        }

        Session::push('orderData', $orderData);

        Session::save();

        DB::beginTransaction();

        try {
            $order = $this->saveOrder($orderData['valorTotal'], $orderData['statusCompra'], $orderData['referencia'],
                $orderData['codigo'], $orderData['dataCompra'], $orderData['valorFrete'], $request->cd_cliente,
                $fk_endereco, strval($xml->shipping->type), strval($cardInfo[0]['installmentQuantity']),
                strval(number_format($cardInfo[0]['installmentAmount'], 2, '.', '')));
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Order');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Order');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Erro ao conectar com o banco de dados - Order');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            foreach ($cartProducts as $key => $product) {
                $sku = Sku::where('cd_nr_sku', '=', $product['skuProduto'])->get();
                $this->saveOrderItem($order->cd_pedido, $sku->cd_sku, 2, $product['qtdIndividual']);
            }
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Item');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Houve um problema ao processar sua compra - Item');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('payment.order.ticket.details')->with('nosuccess', 'Erro ao conectar com o banco de dados - Item');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('payment.result');
    }

    public function saveCreditCardInformation(Request $request)
    {
        //dd($request->all());

        if ($request->has('newToken')) {
            Session::forget('creditCardInfo');

            Session::put('creditCardInfo', []);

            $cardInfo = [
                'cardToken' => $request->cardToken,
                'cardNumber' => $request->cardNumber,
                'cvv' => $request->cvv,
                'expirationMonth' => $request->expirationMonth,
                'expirationYear' => $request->expirationYear,
                'installmentQuantity' => $request->quantity,
                'installmentAmount' => $request->installmentAmount,
                'totalAmount' => $request->totalAmount
            ];

            Session::push('creditCardInfo', $cardInfo);
        } else {
            $cardInfo = Session::get('creditCardInfo');

            $cardInfo[0]['installmentQuantity'] = $request->quantity;
            $cardInfo[0]['installmentAmount'] = $request->installmentAmount;
            $cardInfo[0]['totalAmount'] = $request->totalAmount;

            session([ 'creditCardInfo' => $cardInfo ]);
        }

        Session::save();
    }

    public function getClientData($codCliente)
    {
        return Cli::join('telefone', 'telefone.cd_telefone', 'cliente.cd_telefone')
            ->join('cliente_endereco', 'cliente.cd_cliente', 'cliente_endereco.cd_cliente')
            ->join('endereco', 'cliente_endereco.cd_endereco', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', 'uf.cd_uf')
            ->select('cliente.nm_cliente', 'cliente.cd_cpf_cnpj', 'endereco.ds_endereco',
                'cliente_endereco.id_cliente_endereco', 'cliente_endereco.cd_numero_endereco', 'cliente_endereco.ds_complemento',
                'endereco.cd_cep', 'bairro.nm_bairro', 'cidade.nm_cidade', 'uf.sg_uf',
                'cliente.email', 'telefone.cd_celular1')
            ->where('cliente.cd_cliente', '=', $codCliente)
            //->where('cliente_endereco.ic_principal', '=', 1)
            ->where('endereco.cd_cep', '=', Session::get('cepPrincipal'))
            ->get()->toArray();
    }

    public function getCompanyData()
    {
        $company =  DB::table('dados_empresa')->get()->toArray();
        return $company;
    }

    public function saveOrder($valorTotal, $codStatus, $codReferencia, $codPagSeguro,
                              $dataCompra, $valorFrete, $codCliente, $fk_endereco, $fk_frete, $qt_parcelas, $vl_parcelas)
    {
        //dd($valorTotal, $codStatus, $codReferencia, $codPagSeguro, $dataCompra, $valorFrete, $codCliente, $fk_endereco);
        return Order::create([
            'vl_total' => floatval($valorTotal),
            'cd_status' => $codStatus,
            'cd_referencia' => $codReferencia,
            'cd_pagseguro' => $codPagSeguro,
            'dt_compra' => $dataCompra,
            'vl_frete' => floatval($valorFrete),
            'cd_cliente' => $codCliente,
            'fk_end_entrega_id' => $fk_endereco,
            'dt_alteracao' => $dataCompra,
            'fk_tipo_frete_id' => $fk_frete,
            'qt_parcelas' => $qt_parcelas,
            'vl_parcelas' => $vl_parcelas
        ]);
    }

    public function saveOrderItem($codPedido, $codSKU, $codTipoPagamento, $qtdProduto)
    {
        DB::table('pedido_produto')->insert([
            'cd_pedido' => intval($codPedido),
            'cd_sku' => intval($codSKU),
            'cd_tipo_pagto' => $codTipoPagamento,
            'qt_produto' => intval($qtdProduto)
        ]);
    }

    public function clearShippingData()
    {
        Session::forget('cart');
        Session::forget('qtCart');
        Session::forget('shippingData');
    }

    public function clearCart()
    {
        Session::forget('cart');
        Session::forget('qtCart');
        Session::forget('qtCartItens');

        Session::forget('totalHeight');
        Session::forget('totalWidth');
        Session::forget('totalLength');
        Session::forget('totalWeight');

        Session::forget('orderData');
        Session::forget('creditCardInfo');

        Session::forget('subtotalPrice');
        Session::forget('totalPrice');
    }
}
