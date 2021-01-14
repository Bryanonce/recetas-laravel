<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img src="/storage/{{$receta->imagen}}" class="card-img-top" alt="{{$receta->titulo}}"/>
        <div class="card-body">
            <h3 class="card-title">
                {{$receta->titulo}}
            </h3>
            <div class="meta-receta d-flex justify-content-between">
                <p class="text-primary fecha font-weigth-bold">
                    <fecha-receta 
                        fecha="{{$receta->categoria->created_at}}"
                    ></fecha-receta>
                </p>
                <p>{{count($receta->likes)}} Les Gustó</p>
            </div>
            <p>{{Str::limit(strip_tags($receta->preparacion),50)}}</p>
            <a href="{{route('recetas.show',$receta->id)}}" class="btn btn-primary d-block font-weigth-bold text-uppercase">
                Ver Receta
            </a>
        </div>
    </div>
</div>