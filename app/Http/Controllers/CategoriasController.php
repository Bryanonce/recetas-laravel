<?php

namespace App\Http\Controllers;

use App\Models\CategoriaReceta;
use App\Models\Receta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaReceta $categoriaReceta){
        
        $recetas = Receta::where(array(
            'categoria_id' => $categoriaReceta->id
        ))->paginate(3);

        return view('categorias.show')
            ->with('recetas',$recetas)
            ->with('categoria',$categoriaReceta);
    }
}
