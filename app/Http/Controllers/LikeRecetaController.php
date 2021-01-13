<?php

namespace App\Http\Controllers;

use App\Models\LikeReceta;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Receta;
use Illuminate\Support\Facades\DB;

class LikeRecetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Receta $receta)
    {

        //Buscar el like
        $like = DB::table('like_recetas')
        ->where(array(
            'user_id' => Auth::user()->id,
            'receta_id' => $receta->id
        ))->count();

        if($like<1){
            LikeReceta::create(array(
                'user_id' => Auth::user()->id,
                'receta_id' => $receta->id
            ));
            $res = 'like';
        }else{
            DB::table('like_recetas')
                ->where(array(
                    'user_id' => Auth::user()->id,
                    'receta_id' => $receta->id
                ))
                ->delete();
            $res = 'dislike';
        }
        return $res;
        //return ;
    }
}
