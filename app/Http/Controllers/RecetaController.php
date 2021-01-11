<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Auth::user()->recetas->dd();
        $recetas = Auth::user()->recetas;
        return view('recetas.index')
            ->with('recetas',$recetas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Obtener las categorias sin modelo
        /*$categorias = DB::table('categoria_recetas')
            ->get()->pluck('nombre','id');
        */
        //Con modelo
        $categorias = CategoriaReceta::all(['id','nombre']);

        return view('recetas.create')
            ->with('categorias',$categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validación
        $data = $request->validate(array(
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
            'imagen' => 'required|image',
        ));

        //Optener Ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-recetas','public');

        //Resize
        $img = Image::make(public_path("storage/{$ruta_imagen}"))
            ->fit(1000,550);
        $img->save();

        //Almacenar en la DB sin modelo
        DB::table('recetas')->insert(array(
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id'=> $data['categoria'],
            'created_at' => date('Y-m-d H:i:s'),
        ));

        //Almacenar en la DB con modelo
        /*Auth::user()->recetas->create(array(
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'imagen' => $ruta_imagen,
            'categoria_id'=> $data['categoria'],
        ));*/

        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        return view('recetas.show')
            ->with('receta',$receta);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {

        //Revisar el policy
        $this->authorize('update',$receta);

        //Cargar la View
        $categorias = CategoriaReceta::all(['id','nombre']);
        return view('recetas.edit')
            ->with('categorias',$categorias)
            ->with('receta',$receta);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {

        //Revisar el policy
        $this->authorize('update',$receta);

        //Validación
        $data = $request->validate(array(
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'preparacion' => 'required',
            'ingredientes' => 'required',
        ));
        return "editando";

        //Asignar Valores
        $receta->titulo = $data['titulo'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];
        $receta->categoria_id = $data['categoria'];
        
        //En caso de que el usuario actualice la Imagen
        if(request('imagen')){

            if($receta->imagen){
                //Eliminar Imagen Antigua
                Storage::delete("public/{$receta->imagen}");                
            }

            //Optener Ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-recetas','public');

            //Resize
            $img = Image::make(public_path("storage/{$ruta_imagen}"))
                ->fit(1000,550);
            $img->save();

            //Insertar Imagen
            $receta->imagen = $ruta_imagen;
        }
        
        
        //Guardar Cambios
        $receta->save();

        //Redireccionar
        return redirect()->route('recetas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Revisar el policy
        $this->authorize('delete',$receta);
        
        //Eliminar la receta
        $receta->delete();

        //redirigir
        return redirect()->route('recetas.index');
    }
}
