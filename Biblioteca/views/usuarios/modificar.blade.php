@extends("layouts.plantillaformulario")

@section("Formulario")
    <h1>Modificar usuarios</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label>
            <input class="form-control" value="{{$usuarios["nombre"]}}" id="nombre" type="text" name="nombre">
        </p>

        <p>
            <label for="apellido">Apellido</label>
            <input class="form-control" value="{{$usuarios["apellido"]}}" id="apellido" type="text" name="apellido">
        </p>

        <p>
            <label for="email">Email</label>
            <input class="form-control" value="{{$usuarios["email"]}}" id="email" type="text" name="email">
        </p>

        <p>
            <label for="username">Username</label>
            <input class="form-control" value="{{$usuarios["username"]}}" id="username" type="text" name="username">
        </p>

        <p>
            <label for="password">Password</label>
            <input class="form-control" id="password" type="password" name="password">
        </p>

        <p>
            <label for="avatar">Avatar</label>
            <input class="form-control" id="avatar" type="file" name="avatar">
        <p><img class="w-25 h-25" src="../../imagenes/usuarios/{{ $usuarios["avatar"] }}" alt="">
        </p>

        <p>
            <label for="tipo">
                <select id="tipo" name="tipo" class="form-control">
                    <option value="">Seleccione tipo</option>
                    <option value="bibliotecario">Bibliotecario</option>
                    <option value="alumno">Alumno</option>
                </select>
            </label>
        </p>

        <p>
            <label for="activo">Activo</label>
            <input id="si-activo" type="radio" name="activo" value="1" checked> <label for="si-activo">Si</label>
            <input id="no-activo" type="radio" name="activo" value="0"> <label for="no-activo">No</label>
        </p>

        <p>
            <input type="hidden" name="id" value="{{$usuarios["id"]}}">
            <input class="btn btn-primary btn-sm" type="submit" value="Guardar">
            <a class="btn btn-secondary btn-sm" href="index.php">Cancelar</a>
        </p>
    </form>
@endsection