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
@endsection