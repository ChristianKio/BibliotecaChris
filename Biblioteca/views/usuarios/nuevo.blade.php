@extends("layouts.plantillaformulario")

@section("Formulario")
    <h1>Crear usuarios</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label>
            <input class="form-control" id="nombre" type="text" name="nombre">
        </p>

        <p>
            <label for="apellido">Apellido</label>
            <input class="form-control" id="apellido" type="text" name="apellido">
        </p>

        <p>
            <label for="email">Email</label>
            <input class="form-control" id="email" type="text" name="email">
        </p>

        <p>
            <label for="username">Username</label>
            <input class="form-control" id="username" type="text" name="username">
        </p>

        <p>
            <label for="password">Password</label>
            <input class="form-control" id="password" type="text" name="password">
        </p>

        <p>
            <label for="avatar">Avatar</label>
            <input class="form-control" id="avatar" type="file" name="avatar">
        </p>

        <p>
            <select name="tipo" class="form-control">
                <option value="">Seleccione tipo</option>
                <option value="bibliotecario">Bibliotecario</option>
                <option value="alumno">Alumno</option>
            </select>
        </p>

        <p>
            <label for="activo">Activo</label>
            <input id="si-activo" type="radio" name="activo" value="1" checked> <label for="si-activo">Si</label>
            <input id="no-activo" type="radio" name="activo" value="0"> <label for="no-activo">No</label>
        </p>

        <p>
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection