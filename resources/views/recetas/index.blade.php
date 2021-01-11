@extends('layouts.app')

@section('botones')
    <a href="{{route('recetas.create')}}" class="btn btn-primary">Crear Receta</a>
@endsection

@section('content')
    <h2 class="text-center mb-5">Administra Tus Recetas</h2>
    <div class="d-flex justify-content-center col-12">
        <div class="col-md-10 bg-white p-3 text-center">
            <table class="table">
                <thead class="bg-primary text-ligth">
                    <tr>
                        <th scole="col">Título</th>
                        <th scole="col">Categoría</th>
                        <th scole="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recetas as $receta)
                        <tr>
                            <td>{{$receta->titulo}}</td>
                            <td>{{$receta->categoria->nombre}}</td>
                            <td>
                                <eliminar-receta
                                    receta-id="{{$receta->id}}"
                                ></eliminar-receta>
                                <a href="{{route('recetas.edit',$receta->id)}}" class="btn mb-2 btn-dark d-block">Editar</a>
                                <a href="{{route('recetas.show',$receta->id)}}" class="btn mb-2 btn-success d-block">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
