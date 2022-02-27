@extends("layouts.plantilladetalles")

@section("content")
    @foreach ($libros as $libro)
        <div class="col-sm-2 col-md-12 grid_1_4">
            <div class="picture">
                <img class="img-responsive center-block" src="../../imagenes/libros/{{ $libro["imagen"]}}" alt=""/>
            </div>
            <a class="text-dark text-decoration-none"><h5> {{$libro["titulo"]}}</h5></a>
            <div>
                <p><span><b> Autora:</b> {{$libro["autor"]}}</span></p>
                <p><span><b> Categoria:</b> {{$libro["categoria"]}}</span></p>
            </div>
            <div>
                <p><span> <b>Sinopsis</b> </span></p>
                <p class="text-align-start">{{$libro["sinopsis"]}}</p>
            </div>
        </div>
    @endforeach
@endsection