@extends("layouts.plantillaformulario")

@section("Formulario")
    <h1>Modificar editorial</h1>

    <form action="" method="post">
        <p>
            <label for="nombre">Nombre</label>
            <input class="form-control" id="nombre" type="text" name="nombre" value="{{$editoriales["nombre"]}}">
        </p>

        <p>
            <input type="hidden" name="id" value="{{$editoriales["id"]}}">
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection