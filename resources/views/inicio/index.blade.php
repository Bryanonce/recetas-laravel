@extends('layouts.app')

@section('trixcss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
@endsection

@section('hero')
    <div class="hero-categorias">
        <form action="{{route('recetas.search')}}" class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra una receta para tu proxima comida</p>
                    <input 
                        type="search"
                        name="buscar"
                        class="form-control"
                        placeholder="Buscar Receta"
                    />
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Ultimas Recetas</h2>
        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
                <div class="card">
                    <img 
                        src="/storage/{{$nueva->imagen}}" 
                        alt="{{$nueva->titulo}}"
                        class="card-img-top"
                    />
                    <div class="card-body">
                        <h3>{{Str::title($nueva->titulo)}}</h3>
                        <p>{{Str::limit(strip_tags($nueva->preparacion),50)}}</p>
                        <div class="meta-receta d-flex justify-content-between">
                            <p class="text-primary fecha font-weigth-bold">
                                <fecha-receta 
                                    fecha="{{$nueva->categoria->created_at}}"
                                ></fecha-receta>
                            </p>
                            <p>{{count($nueva->likes)}} Les Gustó</p>
                        </div>
                        <a href="{{route('recetas.show',$nueva->id)}}" class="btn btn-primary d-block font-weigth-bold text-uppercase">
                            Ver Receta
                        </a>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>



    <div class="container">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Recetas mas votadas
        </h2>
        <div class="row">
                @foreach ($votos as $receta)
                    @include('ui.receta')
                @endforeach
        </div>
    </div>





    @foreach ($recetas as $key=>$group)
        <div class="container">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
                {{str_replace('-',' ',$key)}}
            </h2>
            <div class="row">
                @foreach ($group as $recetas)
                    @foreach ($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
    
@endsection