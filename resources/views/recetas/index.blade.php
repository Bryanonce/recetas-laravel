@extends('layouts.app')

@section('botones')
<a href="{{route('recetas.create')}}" class="btn btn-outline-primary">
    Crear Receta
    <img style="height: 50px;margin-left:10px;" src="/storage/icons/letter.svg" alt="">
</a>
<a href="{{route('perfiles.edit',['perfil'=>$perfil_id])}}" class="btn btn-outline-primary">
    Editar Perfil
    <img style="height: 50px;margin-left:10px;" src="/storage/icons/edit.svg" alt="">
</a>
<a href="{{route('perfiles.show',['perfil'=>$perfil_id])}}" class="btn btn-outline-primary">
    Ver Perfil
    <img style="height: 50px;margin-left:10px;" src="/storage/icons/user.svg" alt="">
</a>
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
            <div class="col-12 justify-content-center d-flex">
                {{$recetas->links("pagination::bootstrap-4")}}
            </div>
            <h2 class="text-center my-5">Recetas que te gustaron</h2>
            <div class="col-md-10 mx-auto bg-white p-3">
                @if(count($likes)>0)
                    <ul class="list-group">
                        @foreach($likes as $like)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$like->likes->titulo}}
                                <a class="btn btn-outline-success text-uppercase" href="{{route('recetas.show',$like->likes->id)}}">Ver Receta</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center">Aun no tienes recetas guardadas <br>
                        <small>Dale Me Gusta a las recetas y las verás aquí</small>
                    </p>
                @endif
                
            </div>
            <div class="d-flex justify-content-center">
                {{$likes->links("pagination::bootstrap-4")}}
            </div>
            
        </div>
    </div>
@endsection
