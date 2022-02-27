@extends("layouts.plantilla")

@section("content")
    @foreach ($libros as $libro)
        <div class="col-sm-6 col-md-3 grid_1_4">
            <div class="picture">
                <img class="img-responsive center-block" src="../../imagenes/libros/{{ $libro["imagen"]}}" alt=""/>
            </div>
            <a class="text-dark text-decoration-none" href="admin/detalles.php?id={{$libro["id"]}} "><h5> {{$libro["titulo"]}}</h5></a>
            <div>
                <p><span> {{$libro["autor"]}}</span></p>
                <p><span> {{$libro["categoria"]}}</span></p>
                <p><a class="btn btn-dark" href="admin/prestamos.php?id={{$libro["id"]}}">Pedir prestado</a></p>
            </div>
        </div>
    @endforeach
@endsection
