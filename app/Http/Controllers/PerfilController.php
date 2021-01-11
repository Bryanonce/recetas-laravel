<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Exception;

class PerfilController extends Controller
{
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
        return view('perfiles.show')
            ->with('perfil',$perfil);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
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
        //
    }
}
