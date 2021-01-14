@extends('layouts.app')

@section('botones')
    <a href="{{route('perfiles.show',$receta->user->perfil->id)}}" class="btn btn-primary">
        Ir al Perfil del Autor
        <img style="height: 50px;margin-left:10px;" src="/images/user.svg" alt="">
    </a>
@endsection

@section('content')
    {{-- <h1>{{$receta}}</h1> --}}

    <article class="bordes-redondos p-3 contenido-receta bg-white shadow">
        <h1 
            class="text-center mb-4"
        >
            {{$receta->titulo}}
        </h1>

        <div class="mb-5 d-flex justify-content-center">
            <div class="img-recetas">
                <img 
                    src="/storage/{{$receta->imagen}}" 
                    alt="{{$receta->nombre}}" 
                    class="w-100"
                >
            </div>
            
        </div>
        <div class="mb-5  shadow p-3">
            <div class="receta-meta mt-2 d-flex justify-content-left">
                <div>
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
                        <a class="text-danger" href="{{route('perfiles.show',$receta->user->perfil->id)}}">{{$receta->user->name}}</a>                
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
            </div>
            <like-button
                    receta-id="{{$receta->id}}"
                    like = "{{$like}}"
                    likes = "{{$likes}}"
                ></like-button>
            
        </div>
        
        
        
    </article>
@endsection
