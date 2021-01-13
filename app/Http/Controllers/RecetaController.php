<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\CategoriaReceta;
use App\Models\LikeReceta;
use Exception;
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

        $usuario = Auth::user();
        $likes = LikeReceta::orderBy('updated_at','DESC')
            ->where(array(
                'user_id' => $usuario->id
            ))->paginate(5);
        //$likes = $usuario->meGusta->orderBy('updated_at','DESC');

        //Paginacion
        $recetas = Receta::orderBy('updated_at','DESC')
            ->where('user_id',$usuario->id)
            ->paginate(2);

        $perfil_id = $usuario->perfil->id;
        return view('recetas.index')
            ->with('recetas',$recetas)
            ->with('perfil_id',$perfil_id)
            ->with('likes',$likes);
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
            'updated_at' => date('Y-m-d H:i:s'),
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
        $likes = $receta->likes;
        try{
            $like = DB::table('like_recetas')
            ->where(array(
                'user_id' => Auth::user()->id,
                'receta_id' => $receta->id
            ))
            ->count('receta_id');
        }catch(Exception $err){
            $like = 0;
        }
        
        
        return view('recetas.show')
            ->with('receta',$receta)
            ->with('like',$like)
            ->with('likes',$likes);
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
        $this->authorize('view',$receta);

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

        LikeReceta::where(array(
            'receta_id' => $receta->id
        ))->delete();

        Storage::delete("public/{$receta->imagen}");
        
        $receta->delete();
        

        return redirect()->route('recetas.index');
    }
}
