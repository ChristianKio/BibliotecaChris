@extends('layouts.plantilladash')
@section('content')
    <div>
        <section>
            <div class="container border border-dark">
                <h2><b>USUARIO: </b></h2>
                <h5>Nombre: {{ $_SESSION["usuario"]["nombre"]}}</h5>
                <h5>Apellidos: {{ $_SESSION["usuario"]["apellido"]}}</h5>
                <h5>Email: {{ $_SESSION["usuario"]["email"]}}</h5>
                <form method="post">
                    <a class="btn btn-info btn-sm" href="mod_user.php?id={{$_SESSION["usuario"]['id']}}">
                        MODIFICAR
                    </a>
                </form>
            </div>
            <br>
            <div class="container border border-dark">
                <h2><b>CONTRASEÑA: </b></h2>
                <form method="post">
                    <h5><a class="btn btn-info btn-sm" href="mod_pass.php?id={{$_SESSION["usuario"]['id']}}">
                            MODIFICAR CONTRASEÑA
                        </a></h5>
                </form>
            </div>
            <br>
            <div class="container border border-dark">
                <h2> <b>PRÉSTAMOS: </b></h2>
                @if (!empty($prestamos))
                    <div class="row">
                        @foreach ($prestamos as $key => $value)
                            <div class="justify-content-start col-md-8">
                                <ul>
                                    <li>Libro: {{$value['libro']}}</li>
                                    <li>Fecha del prestamo: {{$value['fecha_prestamo']}}</li>
                                    <li>Fecha de la devolución: {{$value['fecha_devolucion']}}</li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h5> No hay prestamos activos </h5>
                @endif
            </div>
        </section>
@endsection