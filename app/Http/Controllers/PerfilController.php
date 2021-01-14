<?php

namespace App\Http\Controllers;

use App\Models\LikeReceta;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Receta;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{

    //uso de la middleware
    public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {

        //Obtener las recetas con paginacion
        $recetas = Receta::where('user_id',$perfil->user->id)
            ->paginate(3);
        
        return view('perfiles.show')
            ->with('perfil',$perfil)
            ->with('recetas',$recetas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //verifciar el policy
        $this->authorize('view',$perfil);

        return view('perfiles.edit')
            ->with('perfil',$perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {

        //Verificar el policy
        $this->authorize('update',$perfil);

        if($request['imagen']){
            // Validar la entrada de los datos
            $data = $request->validate(array(
               'name' => 'required',
                'url' => 'required',
                'biografia' => '',
                'imagen' => 'image'
            ));
            if($perfil->imagen){
                //Eliminar Imagen Antigua
                Storage::delete("public/{$perfil->imagen}");                
            }
            $ruta_imagen = $request['imagen']->store('upload-perfiles','public');
            $img = Image::make(public_path("storage/{$ruta_imagen}"))
                ->fit(500,500);
            $img->save();
            $perfil->imagen = $ruta_imagen;
        }else{
            $data = $request->validate(array(
                'name' => 'required',
                 'url' => 'required',
                 'biografia' => '',
             ));
        }

        //Guardar Info de Persona
        $user = User::find(array(
            'id' => Auth::user()->id
        ))[0];
        $user->name = $data['name'];
        $user->url = $data['url'];
        $user->save();

        // Proteger los datos del Usuario
        unset($data['name']);
        unset($data['url']);

        // Guardar Inforamción de Perfil
        $perfil->biografia = $data['biografia'];

        //Actualizar
        $perfil->save();        

        // Redireccionar
        return redirect()->route('perfiles.show',$perfil->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //Verificar el policy
        $this->authorize('delete',$perfil);

        //Obtener el id del usuario autentificado
        $id = Auth::user()->id;

        //Eliminar inforamción del perfil del usuario
        if(($perfil->imagen) !== ''){
            Storage::delete("public/{$perfil->imagen}");
        }
        $perfil->delete();

        //Eliminar los Likes creados por el usuario
        LikeReceta::where(array(
            'user_id' => $id
        ))->delete();
        
        //Eliminar las recetas creadas por el usuario
        Receta::where(array(
            'user_id' => $id
        ))->delete();
        $path = "public/upload-recetas/$id";
        Storage::deleteDirectory($path);

        //Cerrar session
        Auth::logout();

        //Eliminar Cuenta
        User::where(array(
            'id' => $id
        ))->delete();

        return 'Eliminado con éxito';
        
        
    }
}
