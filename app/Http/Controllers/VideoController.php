<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(){

        $video = Video::all();

        return view('pages.admin.indexVideo', compact('video'));
    }

    //==================================================================================================================
    //CRIA O VÍDEO
    public function createVideo(VideoRequest $request)
    {
        try {
            Video::firstOrCreate([
                'titulo_video' => $request->titulo_video,
                'url_video' => $request->url_video
            ]);
        }
        catch (\Exception $e){
            return redirect()->route('video.edit')->with('nosuccess', 'Erro ao cadastrar vídeo');
        }

        return redirect()->route('video.edit')->with('success', 'Vídeo cadastrado com sucesso');
    }

    //==================================================================================================================
    //ATUALIZAR O VÍDEO
    public function updateVideo(Request $request){
        try {
            $video = Video::find($request->id_video);
            $video->titulo_video = $request->titulo_video;
            $video->url_video = $request->url_video;
            $video->save();
        }
        catch (\Exception $e){
            return redirect()->route('video.edit')->with('nonsuccess', 'Erro ao atualizar o video.');
        }

        return redirect()->route('video.edit')->with('success', 'Vídeo atualizado com sucesso.');
    }

    //==================================================================================================================
    //DELETA O VIDEO
    public function deleteVideo($id){
        //dd($id);
        try{
            $video = Video::find($id);
            $video->delete();
        }
        catch (\Exception $ex){
            return response()->json(['deuErro' => true]);
        }

        return response()->json(['deuErro' => false]);
    }
}
