<?php

namespace App\Http\Controllers;

use http\Env\Request;

class ProductBlingController extends Controller{

    public function importFromBling(){
        return view('pages.admin.products.integration.bling.listProducts');
    }

    public function searchProds($pagina){
        //$pagina = $_POST["pagina"];
        $apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";
        $loja = "203208658";
        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produtos/' . $pagina . '/' . $outputType . '&loja='. $loja .'&estoque=S';
        $retorno = $this->executeGetProducts($url, $apikey);
        //echo $retorno;
        return response()->json([$retorno]);
    }

    public function executeGetProducts($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function searchCatFather($idCategoria){
        //$idCategoria = $_POST["idCategoria"];
        $apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";
        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/categoria/' . $idCategoria . '/' . $outputType;
        $retorno = $this->executeGetCategories($url, $apikey);

        return response()->json([$retorno]);
    }

    public function executeGetCategories($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }
}


