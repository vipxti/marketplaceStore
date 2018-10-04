<?php

namespace App\Http\Controllers;

use App\Bairro;
use App\Cidade;
use App\Company;
use App\Endereco;
use App\Http\Requests\CompanyDataRequest;
use App\Pais;
use App\Phone;
use App\Uf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    public function showCompanyForm()
    {

        $dadosEmpresa = $this->CompanyData();

        //dd($dadosEmpresa);

        return view('pages.admin.cadDadosEmpresa', compact('dadosEmpresa'));
    }

    public function CompanyData()    {
        $dadosEmpresa = DB::table('dados_empresa')
            ->join('endereco', 'dados_empresa.fk_cd_endereco', '=', 'endereco.cd_endereco')
            ->join('bairro', 'endereco.cd_bairro', '=', 'bairro.cd_bairro')
            ->join('cidade', 'bairro.cd_cidade', '=', 'cidade.cd_cidade')
            ->join('uf', 'cidade.cd_uf', '=', 'uf.cd_uf')
            ->join('pais', 'uf.cd_pais', '=', 'pais.cd_pais')
            ->join('telefone', 'dados_empresa.fk_cd_telefone', '=', 'telefone.cd_telefone')
            ->get();

        return $dadosEmpresa;
    }

    public function updateDataCompany($nm_razao_social, $nm_fantasia, $ic_tipo_pessoa, $cd_cnpj, $cd_ie, $ic_ie_isento, $cd_im, $nm_cnae, $cd_regime_tributario, $cd_api_bling, $cd_api_key, $numero, $ds_complemento, $ds_ponto_referencia, $endereco){

        //dd($nm_razao_social, $nm_fantasia, $ic_tipo_pessoa, $cd_cnpj, $cd_ie, $ic_ie_isento, $cd_im, $nm_cnae, $cd_regime_tributario, $cd_api_bling, $cd_api_key, $numero, $ds_complemento, $ds_ponto_referencia, $endereco);

       /* DB::table('dados_empresa')
                            ->where('cd_dados_empresa', '=', 1)
                            ->update(['nm_razao_social' => $nm_razao_social,
                                'nm_fantasia' => $nm_fantasia,
                                'ic_tipo_pessoa' => $ic_tipo_pessoa,
                                'cd_cnpj' => $cd_cnpj,
                                'cd_ie' => $cd_ie,
                                'ic_ie_isento' => $ic_ie_isento,
                                'cd_im' => $cd_im,
                                'nm_cnae' => $nm_cnae,
                                'cd_regime_tributario' => $cd_regime_tributario,
                                'cd_api_bling' => $cd_api_bling,
                                'cd_api_key' => $cd_api_key,
                                'cd_numero_endereco' => $numero,
                                'ds_complemento' => $ds_complemento,
                                'ds_ponto_referencia' => $ds_ponto_referencia,
                                'fk_cd_endereco' => $endereco
                                ]);*/



        $dadosEmpresa = Company::find(1);

        $dadosEmpresa->nm_razao_social = $nm_razao_social;
        $dadosEmpresa->nm_fantasia = $nm_fantasia;
        $dadosEmpresa->ic_tipo_pessoa = $ic_tipo_pessoa;
        $dadosEmpresa->cd_cnpj = $cd_cnpj;
        $dadosEmpresa->cd_ie = $cd_ie;
        $dadosEmpresa->ic_ie_isento = $ic_ie_isento;
        $dadosEmpresa->cd_im = $cd_im;
        $dadosEmpresa->nm_cnae = $nm_cnae;
        $dadosEmpresa->cd_regime_tributario = $cd_regime_tributario;
        $dadosEmpresa->cd_api_bling = $cd_api_bling;
        $dadosEmpresa->cd_api_key = $cd_api_key;
        $dadosEmpresa->cd_numero_endereco = $numero;
        $dadosEmpresa->ds_complemento = $ds_complemento;
        $dadosEmpresa->ds_ponto_referencia = $ds_ponto_referencia;
        $dadosEmpresa->fk_cd_endereco = $endereco;
        $dadosEmpresa->save();

        //dd($dadosEmpresa);
        //return $dadosEmpresa->fk_cd_telefone;
    }

    public function updatePhone($cd_tel, $num_tel){
        $telefone = Phone::find($cd_tel);

        $telefone->cd_telefone_fixo = $num_tel;

        $telefone->save();
    }

    public function cdPhone(){
        $dadosEmpresa = Company::find(1);

        return $dadosEmpresa['fk_cd_telefone'];
    }

    public function updateCompany(CompanyDataRequest $request){

        //TRATAMENTO DO  CEP, TELEFONE IC ISENTO
        $stIcIeIsento = ($request->filled('ic_ie_isento') == 'on') ? $status = 1 : $status = 0;
        $replaceCep = str_replace('-', '',  $request->cd_cep);
        $replacePhone = str_replace('-', '',  $request->cd_tel);
        $replacePhone = str_replace('(', '',  $replacePhone);
        $replacePhone = str_replace(')', '',  $replacePhone);
        $replacePhone = str_replace(' ', '',  $replacePhone);

        //dd($request->all());

        DB::beginTransaction();


        //ATUALIZAR DADOS DO ENDERECO DA EMPRESA
        //ATUALIZAR PAIS
        try {
            $pais = $this->createCountry($request->nm_pais);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados do pais.');
        }

        //ATUALIZAR UF
        try {
            $estado = $this->createState($request->sg_uf, $pais->toArray()[0]['cd_pais']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados da uf.');
        }

        //ATUALIZAR CIDADE
        try {
            $cidade = $this->createCity($request->nm_cidade, $request->cd_ibge, $estado->toArray()[0]['cd_uf']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados da cidade.');
        }

        //ATUALIZAR BAIRRO
        try {
            $bairro = $this->createNeighbour($request->nm_bairro, $cidade->toArray()[0]['cd_cidade']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados do bairro.');
        }

        //ATUALIZAR ENDEREÇO
        try {
            $endereco = $this->createAddress($replaceCep, $request->ds_endereco, $bairro->toArray()[0]['cd_bairro']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados da empresa.');
        }

        //ATUALIZAR DADOS DA EMPRESA
        try{
            $this->updateDataCompany(
                $request->nm_razao_social,
                $request->nm_fantasia,
                $request->ic_tipo_pessoa,
                $request->cd_cnpj,
                $request->cd_ie,
                $stIcIeIsento,
                $request->cd_im,
                $request->nm_cnae,
                $request->cd_regime_tributario,
                $request->cd_api_bling,
                $request->cd_api_key,
                $request->cd_numero_endereco,
                $request->ds_complemento,
                $request->ds_ponto_referencia,
                $endereco->toArray()[0]['cd_endereco']
            );
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados da empresa.');
        }

        //ATUALIZAR TELEFONE
        try{
            $cd_tel = $this->cdPhone();
            $this->updatePhone($cd_tel, $replacePhone);
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao atualizar os dados do telefone.');
        }

        //dd(Company::find(1));

        return redirect()->route('product.list.bling')->with('success', 'Dados da empresa atualizado com sucesso.');

        //$dadosEmpresa = $this->CompanyData();

        //dd($dadosEmpresa);

        //return view('pages.admin.cadDadosEmpresa', compact('dadosEmpresa'));
    }

    public function registerComnpany(CompanyDataRequest $request)
    {
        //dd($request->all());
        //TRATAMENTO DO  CEP, TELEFONE IC ISENTO
        $stIcIeIsento = ($request->filled('ic_ie_isento') == 'on') ? $status = 1 : $status = 0;
        $replaceCep = str_replace('-', '',  $request->cd_cep);
        $replacePhone = str_replace('-', '',  $request->cd_tel);
        $replacePhone = str_replace('(', '',  $replacePhone);
        $replacePhone = str_replace(')', '',  $replacePhone);
        $replacePhone = str_replace(' ', '',  $replacePhone);



        DB::beginTransaction();

        //PAIS
        try {
            $pais = $this->createCountry($request->nm_pais);
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o país');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o país');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados pais');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //UF
        try {
            $estado = $this->createState($request->sg_uf, $pais->toArray()[0]['cd_pais']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o estado');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o estado');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Uf');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //CIDADE
        try {
            $cidade = $this->createCity($request->nm_cidade, $request->cd_ibge, $estado->toArray()[0]['cd_uf']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar a cidade');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar a cidade');
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Cidade');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //BAIRRO
        try {
            $bairro = $this->createNeighbour($request->nm_bairro, $cidade->toArray()[0]['cd_cidade']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o bairro');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o bairro');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Bairro');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //ENDEREÇO
        try {
            $endereco = $this->createAddress($replaceCep, $request->ds_endereco, $bairro->toArray()[0]['cd_bairro']);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o endereço');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o endereço');
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de dados Endereço');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //PHONE
        try {
            $phone = $this->createPhone($replacePhone);
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o Telefone');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o Telefone');
        } catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de Telefone');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        //EMPRESA
        try {

            $this->createCompany(
                $request->nm_razao_social,
                $request->nm_fantasia,
                $request->ic_tipo_pessoa,
                $request->cd_cnpj,
                $request->cd_ie,
                $stIcIeIsento,
                $request->cd_im,
                $request->nm_cnae,
                $request->cd_regime_tributario,
                $request->cd_api_bling,
                $request->cd_api_key,
                $request->image,
                $request->cd_numero_endereco,
                $request->ds_complemento,
                $request->ds_ponto_referencia,
                $phone->cd_telefone,
                $endereco->toArray()[0]['cd_endereco']
            );
        } catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar os Dados');
        } catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o Dados');
        } catch (\PDOException $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de Dados Empresa');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        //$dadosEmpresa = $this->CompanyData();

        //return view('pages.admin.cadDadosEmpresa');

        return redirect()->route('admin.dashboard')->with('success', 'Dados da Empresa Cadastrados com Sucesso');

    }

    //INSERT ENDERECO
    public function createCountry($nomePais)
    {
        $idPais = Pais::where('nm_pais', 'like', '%'.$nomePais.'%')->select('cd_pais')->get();
        if (count($idPais) == 0){
            Pais::create([
                'nm_pais' => $nomePais
            ]);
            $idPais = Pais::where('nm_pais', 'like', '%'.$nomePais.'%')->select('cd_pais')->get();
            return $idPais;
        }
        else{
            return $idPais;
        }
    }

    public function createState($siglaEstado, $codPais)
    {
        $idUf = Uf::where('sg_uf', 'like', '%'.$siglaEstado.'%')->select('cd_uf')->get();
        if (count($idUf) == 0){
             Uf::create([
                'sg_uf' => $siglaEstado,
                'cd_pais' => $codPais
            ]);
            $idUf = Uf::where('sg_uf', 'like', '%'.$siglaEstado.'%')->select('cd_uf')->get();
            return $idUf;
        }
        else{
            return $idUf;
        }
    }

    public function createCity($nomeCidade, $codIbge, $codEstado)
    {
        $idCidade = Cidade::where('nm_cidade', 'like', '%'.$nomeCidade.'%')->select('cd_cidade')->get();
        //var_dump($idCidade);
        if (count($idCidade) == 0){
            Cidade::create([
                'nm_cidade' => $nomeCidade,
                'cd_ibge' => $codIbge,
                'cd_uf' => $codEstado
            ]);
            $idCidade = Cidade::where('nm_cidade', 'like', '%'.$nomeCidade.'%')->select('cd_cidade')->get();
            return $idCidade;
        }
        else{
            return $idCidade;
        }
    }

    public function createNeighbour($nomeBairro, $codCidade)
    {
        $idBairro = Bairro::where('nm_bairro', 'like', '%'.$nomeBairro.'%')->select('cd_bairro')->get();
        if (count($idBairro) == 0){
            Bairro::create([
                'nm_bairro' => $nomeBairro,
                'cd_cidade' => $codCidade
            ]);
            $idBairro = Bairro::where('nm_bairro', 'like', '%'.$nomeBairro.'%')->select('cd_bairro')->get();
            return $idBairro;
        }
        else{
            return $idBairro;
        }
    }

    public function createAddress($cep, $endereco, $codBairro)
    {
        $idEnd = Endereco::where('cd_cep', '=', $cep)->select('cd_endereco')->get();
        //dd($idEnd);
        if (count($idEnd) == 0){
            Endereco::create([
                'cd_cep' => $cep,
                'ds_endereco' => $endereco,
                'cd_bairro' => $codBairro
            ]);
            $idEnd = Endereco::where('cd_cep', '=', $cep)->select('cd_endereco')->get();
            return $idEnd;
        }
        else{
            return $idEnd;
        }
    }

    //INSERT TELEFONE
    public function createPhone($cd_telefone_fixo)
    {
        return Phone::create([
            'cd_telefone_fixo' => $cd_telefone_fixo,
        ]);
    }

    //INSERT DADOS EMPRESSA
    public function createCompany($nm_razao_social, $nm_fantasia, $ic_tipo_pessoa, $cd_cnpj, $cd_ie, $ic_ie_isento, $cd_im, $nm_cnae, $cd_regime_tributario, $cd_api_bling,  $cd_api_key, $image, $numero, $ds_complemento, $ds_ponto_referencia, $cd_tel, $cd_end){
        return Company::create([
            'nm_razao_social' => $nm_razao_social,
            'nm_fantasia' => $nm_fantasia,
            'ic_tipo_pessoa' => $ic_tipo_pessoa,
            'cd_cnpj' => $cd_cnpj,
            'cd_ie' => $cd_ie,
            'ic_ie_isento' => $ic_ie_isento,
            'cd_im' => $cd_im,
            'nm_cnae' => $nm_cnae,
            'cd_regime_tributario' => $cd_regime_tributario,
            'cd_api_bling' => $cd_api_bling,
            'cd_api_key' => $cd_api_key,
            '$image' => $image,
            'cd_numero_endereco' => $numero,
            'ds_complemento' => $ds_complemento,
            'ds_ponto_referencia' => $ds_ponto_referencia,
            'fk_cd_telefone' => $cd_tel,
            'fk_cd_endereco' => $cd_end,
        ]);
    }
}
