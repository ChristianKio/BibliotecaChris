@extends(".layouts.plantillaindex")

@section("Encabezado")
    <h1>Editoriales</h1>
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
        <th>Nombre</th>

        <th colspan="2">Opciones</th>

    </tr>
    @foreach ($editoriales as $c => $valor)
        <tr>
            <td> {{ $valor["id"] }}</td>
            <td>{{ $valor["nombre"] }}</td>
            <td><a class="btn btn-primary btn.sm" href="modificar.php?id={{$valor["id"]}}">
                    <i class="fas fa-pen"></i>
                </a></td>
            <td><a class="btn btn-danger btn.sm" onclick="alerta()"
                   href="borrar.php?id={{$valor["id"]}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
        </tr>
    @endforeach

    {{ "Numero de registros: ".count($editoriales) }}

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