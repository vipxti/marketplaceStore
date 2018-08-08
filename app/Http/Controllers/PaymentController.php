<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Phone;
use App\Client as Cli;

class PaymentController extends Controller
{
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

            return view('pages.app.cart.checkout', compact('months', 'years'));
        }

        Session::put('checkoutRoute', 'payment.checkout');

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

        return view('pages.app.cart.orderdetails', compact('cart', 'shippingData', 'creditCardInfo', 'paymentType'));
    }

    public function showResultPage()
    {
        $cart = Session::get('cart');
        $orderData = Session::get('orderData');

        if ($cart == null) {
            return redirect()->route('cart.page');
        }

        return view('pages.app.cart.result', compact('orderData'));
    }

    public function createSessionId(Request $request)
    {
        $data['token'] ='4D97A178277542CAAB150D1096002DF1';
        $emailPagseguro = 'vendas@vipx.com.br';
        
        $data = http_build_query($data);
        $url = 'https://ws.pagseguro.uol.com.br/v2/sessions';
        
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
        
        $response = [ 'idSessao' => $idSessao];

        return response()->json($response);
    }

    public function ticketPayment(Request $request)
    {
        $pagSeguroData = [];
        $cartProducts = Session::get('cart');
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

        $pagSeguroData['notificationURL'] = '';
        $pagSeguroData['reference'] = uniqid('cp', true);

        $clientData = $this->getClientData($request->cd_cliente);

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

        $xml = simplexml_load_string($xml);

        $orderData = [
            'codigo' => strval($xml->code),
            'dataCompra' => strval($xml->date),
            'tipoPagamento' => 'boleto',
            'statusCompra' => strval($xml->status),
            'linkBoleto' => strval($xml->paymentLink),
            'valorTotal' => strval($xml->grossAmount),
            'valorFrete' => strval($xml->shipping->cost)
        ];

        if (strval($xml->shipping->type) == '1') {
            $orderData['tipoFrete'] = 'Pac';
        } else {
            $orderData['tipoFrete'] = 'Sedex';
        }

        Session::push('orderData', $orderData);

        Session::save();

        return redirect()->route('payment.result');
    }

    public function creditCardPayment(Request $request)
    {
        //dd($request->all());

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
        $pagSeguroData['reference'] = uniqid('cp', true);

        $clientData = $this->getClientData($request->cd_cliente);

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

        $orderData = [
            'codigo' => strval($xml->code),
            'dataCompra' => strval($xml->date),
            'statusCompra' => strval($xml->status),
            'tipoPagamento' => 'cartao',
            'valorTotal' => strval($xml->grossAmount),
            'valorFrete' => strval($xml->shipping->cost)
        ];

        if (strval($xml->shipping->type) == '1') {
            $orderData['tipoFrete'] = 'Pac';
        } else {
            $orderData['tipoFrete'] = 'Sedex';
        }

        Session::push('orderData', $orderData);

        Session::save();

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
        return Cli::join('telefone', 'telefone.cd_telefone', 'cliente.cd_telefone')->join('cliente_endereco', 'cliente.cd_cliente', 'cliente_endereco.cd_cliente')->join('endereco', 'cliente_endereco.cd_endereco', 'endereco.cd_endereco')->join('bairro', 'endereco.cd_bairro', 'bairro.cd_bairro')->join('cidade', 'bairro.cd_cidade', 'cidade.cd_cidade')->join('uf', 'cidade.cd_uf', 'uf.cd_uf')->select('cliente.nm_cliente', 'cliente.cd_cpf_cnpj', 'endereco.ds_endereco', 'cliente_endereco.cd_numero_endereco', 'cliente_endereco.ds_complemento', 'endereco.cd_cep', 'bairro.nm_bairro', 'cidade.nm_cidade', 'uf.sg_uf', 'cliente.email', 'telefone.cd_celular1')->where('cliente.cd_cliente', '=', $codCliente)->where('cliente_endereco.ic_principal', '=', 1)->get()->toArray();
    }
}
