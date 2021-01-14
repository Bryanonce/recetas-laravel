@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="titulo-categoria">
            Busqueda: {{$busqueda}}
        </h2>
        <div class="row">
            @foreach ($recetas as $receta)
                @include('ui.receta')
            @endforeach
        </div>
        <div class="mt-5 d-flex justify-content-center">
            {{$recetas->links("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection