@extends(".layouts.plantillaindex")

@section("Encabezado")
    <h1>Libros</h1>
    <div class="d-flex justify-content-between mb-2">
        <form action="" method="post">
            <div class="input-group">
                <label>
                    <input class="form-control" type="text" name="buscar">
                </label>
                <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"> Buscar</i>
                </button>
            </div>
        </form>
        <p><a class="btn btn-success btn-sm" href="nuevo.php"><i class="fa fa-plus-circle" aria-hidden="true">Nuevo</i></a>
        </p>
    </div>
@endsection

@section("tabla")
    <tr>
        <th>Id</th>
        <th>Titulo</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Imagen</th>
        <th>Categoria</th>
        <th>Disponibilidad</th>
        <th colspan="2">Opciones</th>
    </tr>
    @foreach ($libros as $l => $valor)
        <tr>
            <td> {{ $valor["id"] }}</td>
            <td>{{ $valor["titulo"] }}</td>
            <td>{{ $valor["autor"] }}</td>
            <td>{{ $valor["editorial"] }}</td>
            <td><img class="w-25 h-25" src="../../imagenes/libros/{{ $valor["imagen"] }}" alt=""></td>
            <td>{{ $valor["categoria"] }}</td>
            <td><i class='fa fa-circle {{ $valor["disponibilidad"] ? 'text-success': 'text-danger' }}'></i></td>
            <td><a class="btn btn-primary btn.sm" href="modificar.php?id={{$valor["id"]}}">
                    <i class="fas fa-pen"></i>
                </a></td>
            <td><a class="btn btn-danger btn.sm" onclick="alerta()"
                   href="borrar.php?id={{$valor["id"]}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
    @endforeach

    {{ "Numero de registros: ".count($libros) }}

@endsection

<script>
    function alerta() {
        let mensaje;
        const opcion = confirm("Clicka en Aceptar o Cancelar");
        if (opcion === true) {
            mensaje = "Has clickado OK";
        } else {
            mensaje = "Has clickado Cancelar";
        }
        document.getElementById("ejemplo").innerHTML = mensaje;
    }
</script>