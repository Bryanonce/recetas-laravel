@extends('layouts.app')

@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary">
        Ir a Receta
        <img style="height: 50px;margin-left:10px;" src="/images/atras.svg" alt="">
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
    <div class="pt-5 pb-5 bordes-redondos shadow bg-white">
        <h2 class="text-center mb-5">Crea Tus Recetas</h2>

        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <form enctype="multipart/form-data" action="{{route('recetas.store')}}" method="POST" novalidate>
                    @csrf
                    <div class="form-group">
                        <label for="titulo">Titulo:</label>
                        <input 
                            name="titulo"
                            type="text"
                            class="form-control
                            @error('titulo')
                                is-invalid
                            @enderror"
                            id="titulo"
                            placeholder="Inserte el título"
                            value="{{old('titulo')}}"
                        />
                        @error('titulo')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select 
                            class="form-control
                            @error('categoria')
                                is-invalid
                            @enderror" 
                            name="categoria" 
                            id="categoria"
                        >
                            <option value="">-->Seleccione</option>
                            @foreach ($categorias as $categoria)
                                <option 
                                    value="{{$categoria->id}}" 
                                    {{old('categoria')==$categoria->id? 'selected':''}}
                                >
                                    {{$categoria->nombre}}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="ingredientes">Ingredientes:</label>
                        <input 
                            id="ingredientes" 
                            type="hidden" 
                            name="ingredientes"
                            value="{{old('ingredientes')}}"
                        />
                        <trix-editor 
                            input="ingredientes"
                            class="form-control
                            @error('ingredientes')
                                is-invalid
                            @enderror"
                        ></trix-editor>
                        @error('ingredientes')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="preparacion">Preparación:</label>
                        <input 
                            id="preparacion" 
                            type="hidden" 
                            name="preparacion"
                            value="{{old('preparacion')}}"
                        />
                        <trix-editor 
                            input="preparacion"
                            class="form-control
                            @error('preparacion')
                                is-invalid
                            @enderror"
                        ></trix-editor>
                        @error('preparacion')
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
                            value="{{old('imagen')}}"
                        />
                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Agregar Receta">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
    
@endsection