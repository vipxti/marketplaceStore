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
    public function showCompanyForm(){
        return view('pages.admin.cadDadosEmpresa');
    }

    public function registerComnpany(CompanyDataRequest $request)
    {
        $stIcIeIsento = ($request->filled('ic_ie_isento') == 'on') ? $status = 1 : $status = 0;
        $replaceCep = str_replace('-', '',  $request->cd_cep);
        $replacePhone = str_replace('-', '',  $request->cd_tel);
        $replacePhone = str_replace('(', '',  $replacePhone);
        $replacePhone = str_replace(')', '',  $replacePhone);
        $replacePhone = str_replace(' ', '',  $replacePhone);

        //ENDERECO
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
        }  catch (QueryException $e) {
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
            //dd($bairro->cd_bairro);
            $endereco = $this->createAddress($replaceCep, $request->ds_endereco, $request->ds_numero_endereco, $bairro->cd_bairro);

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
        try{
            $phone = $this->createPhone($replacePhone);
        }
        catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o Telefone');
        }
        catch (QueryException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o Telefone');
        }
        catch (\PDOException $e) {
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de Telefone');
        }
        catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try{
            //dd($endereco->cd_endereco);
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
                $request->ds_complemento,
                $request->ds_ponto_referencia,
                $phone->cd_telefone,
                $endereco->cd_endereco
            );
        }
        catch (ValidationException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar os Dados');
        }
        catch (QueryException $e) {
            DB::rollBack();
            dd($e->getMessage());

            return redirect()->route('company.data')->with('nosuccess', 'Erro ao cadastrar o Dados');
        }
        catch (\PDOException $e) {
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->route('company.data')->with('nosuccess', 'Erro ao conectar com o banco de Dados Empresa');
        }
        catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return view('pages.admin.cadDadosEmpresa');
    }

    //INSERT ENDERECO
    public function createCountry($nomePais)
    {
        $idPais = Pais::where('nm_pais', 'like', '%'.$nomePais.'%')->select('cd_pais')->get();
        if (count($idPais) == 0){
            return Pais::create([
                'nm_pais' => $nomePais
            ]);
        }else{
            return $idPais;
        }
    }

    public function createState($siglaEstado, $codPais)
    {
        $idUf = Uf::where('sg_uf', 'like', '%'.$siglaEstado.'%')->select('cd_uf')->get();
        if (count($idUf) == 0){
            return Uf::create([
                'sg_uf' => $siglaEstado,
                'cd_pais' => $codPais
            ]);
        }else{
            return $idUf;
        }
    }

    public function createCity($nomeCidade, $codIbge, $codEstado)
    {
        $idCidade = Cidade::where('nm_cidade', 'like', '%'.$nomeCidade.'%')->select('cd_cidade')->get();
        if (count($idCidade) == 0){
            return Cidade::create([
                'nm_cidade' => $nomeCidade,
                'cd_ibge' => $codIbge,
                'cd_uf' => $codEstado
            ]);
        }else{
            return $idCidade;
        }
    }

    public function createNeighbour($nomeBairro, $codCidade)
    {
        $idBairro = Bairro::where('nm_bairro', 'like', '%'.$nomeBairro.'%')->select('cd_bairro')->get();
        //dd($idBairro);
        if (count($idBairro) == 0){
            $insertCdBairro =  Bairro::create([
                'nm_bairro' => $nomeBairro,
                'cd_cidade' => $codCidade
            ]);

            return $insertCdBairro;
        }else{
            return $idBairro;
        }
    }

    public function createAddress($cep, $endereco, $numero, $codBairro)
    {
        $idEnd = Endereco::where('cd_cep', '=', $cep)->select('cd_endereco')->get();
        //dd($idEnd);
        if (count($idEnd) == 0){
            return Endereco::create([
                'cd_cep' => $cep,
                'ds_endereco' => $endereco,
                'cd_numero_endereco' => $numero,
                'cd_bairro' => $codBairro
            ]);
        }else{
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
    public function createCompany($nm_razao_social, $nm_fantasia, $ic_tipo_pessoa, $cd_cnpj, $cd_ie, $ic_ie_isento, $cd_im, $nm_cnae, $cd_regime_tributario, $cd_api_bling, $cd_api_key, $image, $ds_complemento, $ds_ponto_referencia, $cd_tel, $cd_end){
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
            'ds_complemento' => $ds_complemento,
            'ds_ponto_referencia' => $ds_ponto_referencia,
            'fk_cd_telefone' => $cd_tel,
            'fk_cd_endereco' => $cd_end,
        ]);
    }
}
