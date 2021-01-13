@extends('layouts.app')

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary">
        Ir a Receta
        <img style="height: 50px;margin-left:10px;" src="/storage/icons/atras.svg" alt="">
    </a>
@endsection

<!-- Importar el Trix Editor -->
@section('trixcss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
@endsection

@section('trixjs')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" defer></script>
@endsection
<!-- Fin de la IMportación -->

@section('content')
    {{--$perfil--}}

    <h1 class="text-center">Editar Mi Perfil</h1>
    <div class="row justify-content-center">
        <div class="col-md-10 bg-withe p-3">
            <form enctype="multipart/form-data" action="{{route('perfiles.update',$perfil->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input 
                        name="name"
                        type="text"
                        class="form-control
                        @error('name')
                            is-invalid
                        @enderror"
                        id="name"
                        placeholder="Inserte el Nombre"
                        value="{{$perfil->user->name}}"
                    />
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Url:</label>
                    <input 
                        name="url"
                        type="text"
                        class="form-control
                        @error('url')
                            is-invalid
                        @enderror"
                        id="url"
                        placeholder="Inserte el Url"
                        value="{{$perfil->user->url}}"
                    />
                    @error('url')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">Biografía:</label>
                    <input 
                        id="biografia" 
                        type="hidden" 
                        name="biografia"
                        value="{{$perfil->biografia}}"
                    />
                    <trix-editor 
                        input="biografia"
                        class="form-control
                        @error('biografia')
                            is-invalid
                        @enderror"
                    ></trix-editor>
                    @error('biografia')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input 
                        name="imagen"
                        type="file"
                        class="form-control
                        @error('imagen')
                            is-invalid
                        @enderror"
                        id="imagen"
                        placeholder="Inserte la imagen"
                    />

                    @if($perfil->imagen)
                        <div class="mt-4">
                            <p>Imagen Actual:</p>
                            <img src="/storage/{{$perfil->imagen}}" alt="{{$perfil->user->name}}" style="width:300px">
                        </div>
                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    @endif
                    
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Confirmar Cambios">
                </div>

            </form>
        </div>
    </div>

@endsection