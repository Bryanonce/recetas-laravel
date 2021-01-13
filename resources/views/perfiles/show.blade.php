@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if($perfil->imagen)
                    <img 
                        src="/storage/{{$perfil->imagen}}" 
                        alt="{{$perfil->user->nombre}}"
                        class="w-100 rounded-circle"
                    />
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 
                    class="
                        text-center
                        mb-2
                        text-primary
                    "
                >
                    {{$perfil->user->name}}
                </h2>
                <a href="{{$perfil->user->url}}">Visitar Sitio Web</a>
                <div class="biografia">
                    {!! $perfil->biografia !!}
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-center mt-4">Recetas Creadas por: {{$perfil->user->name}}</h2>
    <div class="container">
        <div class="row mx-auto bg-withe p-4">
            @if(count($recetas)>0)
                @foreach($recetas as $receta)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img 
                                src="/storage/{{$receta->imagen}}" 
                                alt="{{$receta->titulo}}"
                                class="card-img-top"
                            >
                            <div class="card-body">
                                <h3>{{$receta->titulo}}</h3>
                                <a href="{{route('recetas.show',['receta'=>$receta->id])}}" class="btn btn-primary d-block text-uppercase font-weigth-bold">Ver Receta</a>
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">No hay Recetas Creadas por este usuario</p>
            @endif
        </div>
    </div>
    <div class="justify-content-center d-flex">
        {{$recetas->links("pagination::bootstrap-4")}}
    </div>
    
@endsection