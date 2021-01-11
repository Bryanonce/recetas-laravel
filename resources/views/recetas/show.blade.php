@extends('layouts.app')



@section('content')
    {{-- <h1>{{$receta}}</h1> --}}

    <article class="contenido-receta">
        <h1 
            class="text-center mb-4"
        >
            {{$receta->titulo}}
        </h1>
        
        <div class="img-receta">
            <img 
                src="/storage/{{$receta->imagen}}" 
                alt="{{$receta->nombre}}" 
                class="w-100"
            >
        </div>
        
        <div class="receta-meta mt-2">
            <p>
                <span 
                    class=
                    "
                        font-wigth-bold 
                        text-primary
                    "
                >
                    Escrito en:
                </span>
                {{$receta->categoria->nombre}}
            </p>
            <p>
                <span 
                    class=
                    "
                        font-wigth-bold 
                        text-primary
                    "
                >
                    Autor:
                </span>
                {{-- TODO: mostrar el usuario --}}
                {{$receta->user->name}}
            </p>
            <p>
                <span 
                    class=
                    "
                        font-wigth-bold 
                        text-primary
                    "
                >
                    Fecha de Creación:
                </span>
                <fecha-receta 
                    fecha="{{$receta->categoria->created_at}}"
                ></fecha-receta>
                {{--$receta->categoria->created_at--}}
            </p>
            
            <p>
                <span 
                    class=
                    "
                        font-wigth-bold 
                        text-primary
                    "
                >
                    Ultima Actualización:
                </span>
                <fecha-receta 
                    fecha="{{$receta->categoria->updated_at}}"
                ></fecha-receta>
                {{--$receta->categoria->updated_at--}}
            </p>

            <div class="ingredientes">
                <h2 
                    class="my-2 text-primary"
                >
                    Ingredientes:
                </h2>
                {!! $receta->ingredientes !!}
            </div>

            <div class="preparacion">
                <h2 
                    class="my-2 text-primary"
                >
                    Preparación:
                </h2>
                {!! $receta->preparacion !!}
            </div>

        </div>
    </article>
@endsection
