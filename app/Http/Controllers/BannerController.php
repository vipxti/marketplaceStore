<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Http\Requests\BannerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class BannerController extends Controller
{
    //==================================================================================================================
    //FUNÇÃO CHAMADA PARA SALVAR O BANNER
    public function saveBanner(BannerRequest $request){
        //dd($request->all());
        //Cria o caminho físico das imagens
        try {
            if ($request->hasFile('images')) {
                $image = $request->images;
                //dd($image);
                //$imagePath = $this->pastaProduto($this->getCategoryName($request->cd_categoria), $this->getSubcategoryName($request->cd_sub_categoria));
                $imagePath = public_path('img/app/banner');
                //$dbPath = $this->getCategoryName($request->cd_categoria) . '/' . $this->getSubcategoryName($request->cd_sub_categoria);

                $ext = $image[0]->getClientOriginalExtension();
                $imageName = $request->titulo_banner . '.' . $ext;
                //dd($imageName);
                $realPath = $image[0]->getRealPath();
                //dd($realPath);

                $this->saveImageFile($imagePath, $imageName, $realPath);

                $localImagesPath = $imagePath . '/' . $imageName;

                $img = $this->createBanner($imageName, $request->titulo_banner, $request->url_banner);

                $imgsPath = $img->img_banner;
            }
            else {
                return redirect()->route('banner.edit')->with('nosuccess', 'Erro ao cadastrar banner');
            }
        }
        catch (\Exception $e){
            return redirect()->route('banner.edit')->with('nosuccess', 'Erro ao cadastrar banner');
        }

        return redirect()->route('banner.edit')->with('success', 'Banner cadastrado com sucesso');

    }

    //==================================================================================================================
    //SALVA O ARQUIVO DA IMAGEM
    public function saveImageFile($imagePath, $imageName, $realPath)
    {
        Image::make($realPath)->save($imagePath . '/' . $imageName);
    }

    //==================================================================================================================
    //CRIA O BANNER
    public function createBanner($imagemBanco, $titulo, $url)
    {
        return Banner::firstOrCreate([
            'titulo_banner' => $titulo,
            'img_banner' => $imagemBanco,
            'url_banner' => $url
        ]);
    }

    //==================================================================================================================
    //DELETA O BANNER
    public function deleteBanner($id){
        //dd($id);
        try{
            $banner = Banner::find($id);
            $this->deleteImageFile($banner->img_banner);
            $banner->delete();
        }
        catch (\Exception $ex){
            DB::rollback();
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);
    }

    //==================================================================================================================
    //DELETA A IMAGEM
    public function deleteImageFile($caminhoImagem)
    {
        $rootProductsPath = public_path('img/app/banner/');

        unlink($rootProductsPath . $caminhoImagem);
    }

    //==================================================================================================================
    //ATUALIZAR O BANNER
    public function updateBanner(Request $request){
        try {
            $banner = Banner::find($request->id_banner);
            $banner->titulo_banner = $request->titulo_banner;
            $banner->url_banner = $request->url_banner;
            $banner->save();
        }
        catch (\Exception $e){
            return redirect()->route('banner.edit')->with('nonsuccess', 'Erro ao atualizar banner.');
        }

        return redirect()->route('banner.edit')->with('success', 'Banner atualizado com sucesso.');
    }
}
