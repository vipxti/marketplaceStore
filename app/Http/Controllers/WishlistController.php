<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Sku;
use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function saveWishlist(WishlistRequest $request){
        //dd($request->all());

        $wishlist = Wishlist::join('sku', 'wishlist.fk_id_sku', '=', 'sku.cd_sku')
                    ->join('cliente', 'wishlist.fk_id_cliente', '=', 'cliente.cd_cliente')
                    ->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)
                    ->where('sku.cd_nr_sku', '=', $request->fk_id_sku)
                    ->get();

        if(count($wishlist) > 0){
            try {
                $deleteWish = Wishlist::find($wishlist[0]->id_wishlist);
                $deleteWish->delete();
            }
            catch (\Exception $e){
                throw $e;
                /*return response()->json([
                    'data' => 'erro deletar',
                    'deuErro' => true,
                ]);*/
            }
        }
        else{
            try{
                $sku = Sku::where('cd_nr_sku', '=', $request->fk_id_sku)->get();

                Wishlist::firstOrCreate([
                    'fk_id_sku' => $sku[0]->cd_sku,
                    'fk_id_cliente' => Auth::user()->cd_cliente
                ]);
            }
            catch (\Exception $e){
                throw $e;
                /*return response()->json([
                    'data' => 'erro cadastro',
                    'deuErro' => true,
                ]);*/
            }
        }

        return response()->json([
            'data' => 'sucesso',
            'deuErro' => false,
        ]);

    }

    public function deleteWish(WishlistRequest $request){
        //dd($request->all());

        try{
            $wish = Wishlist::join('sku', 'wishlist.fk_id_sku', '=', 'sku.cd_sku')
                ->join('cliente', 'wishlist.fk_id_cliente', '=', 'cliente.cd_cliente')
                ->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)
                ->where('sku.cd_nr_sku', '=', $request->fk_id_sku)
                ->get();

            $wish[0]->delete();
        }
        catch (\Exception $e){
            throw $e;
        }

        $wishlist = Wishlist::join('sku', 'wishlist.fk_id_sku', '=', 'sku.cd_sku')
            ->join('cliente', 'wishlist.fk_id_cliente', '=', 'cliente.cd_cliente')
            ->where('cliente.cd_cliente', '=', Auth::user()->cd_cliente)
            ->get();

        return response()->json([
            'deuErro' => false,
            'wish' => $wishlist
        ]);
    }
}
