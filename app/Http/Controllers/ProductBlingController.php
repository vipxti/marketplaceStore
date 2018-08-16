<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use http\Env\Request;
use Illuminate\Support\Facades\DB;

class ProductBlingController extends Controller{

    public function importFromBling(){
        return view('pages.admin.products.integration.bling.listProducts');
    }

    public function vinculoCategorias(){

        $categorias = Category::all();

        return view('pages.admin.products.integration.bling.categoryBond', compact('categorias'));
    }

    public function CompanyData(){
        $dadoUsuario = DB::table('dados_empresa')->get();

        if(count($dadoUsuario) == 0){
            return response()->json([
                'message' => false
            ]);
        }

        return response()->json([
            'message' => true
        ]);
    }

    public function searchProds($pagina){
        //$pagina = $_POST["pagina"];
        //$apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";
        //$loja = "203208658";

        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;
        $loja = $dadoUsuario[0]->cd_api_bling;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/produtos/' . $pagina . '/' . $outputType . '&imagem=S&loja='. $loja .'&estoque=S';
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

    public function getCategories(){
        //$apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";

        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;

        $outputType = "json";
        $url = 'https://bling.com.br/Api/v2/categorias/' . $outputType;

        $retorno = $this->executeGetCategories($url, $apikey);
        //echo $retorno;
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

    public function getStoreCategories(){

        $dadoUsuario = DB::table('dados_empresa')->get();

        $apikey = $dadoUsuario[0]->cd_api_key;
        $idLoja = $dadoUsuario[0]->cd_api_bling;
        //$apikey = "2a51570170237bfda75036d304640a61ba9c4330bc33e3551e39e8454ea4f838ceb58337";
        //$idLoja = "203208658";
        $outputType = "json";
        //$url = 'https://bling.com.br/Api/v2/categoriasLoja/' . $outputType;
        $url = 'https://bling.com.br/Api/v2/categoriasLoja/' . $idLoja . '/' . $outputType;
        $retorno = $this->executeGetStoreCategories($url, $apikey);
        //echo $retorno;
        return response()->json([$retorno]);
    }

    public function executeGetStoreCategories($url, $apikey){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $url . '&apikey=' . $apikey);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        return $response;
    }

    public function saveAllProducts(ProductRequest $request){

    }

    public function saveAllCategories(Request $request){

    }

    /*public function searchCatFather($idCategoria){
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
    }*/
}


