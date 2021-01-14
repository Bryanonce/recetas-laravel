<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\CategoriaReceta;
use Illuminate\Support\Str;


class InicioController extends Controller
{
    //
    public function index(){

        // Recetas mas votadas
        $votos = Receta::withCount('likes')
            ->orderBy('likes_count','desc')
            ->limit(3)
            ->get();

        
        //Obtener Categoria
        $categorias = CategoriaReceta::all();
        
        //Obtener las recetas mas nuevas
        $nuevas = Receta::latest()
            ->limit(10)
            ->get();
        
        // Agrupar las recetas por categoria
        $recetas = [];

        foreach($categorias as $categoria){
            $recetas[Str::slug($categoria->nombre)][] = Receta::latest()
                ->where('categoria_id',$categoria->id)
                ->limit(3)
                ->get();
        }
        
        return view('inicio.index')
            ->with('nuevas',$nuevas)
            ->with('recetas',$recetas)
            ->with('votos',$votos);
    }
}
