@extends("layouts.plantillaindexadmin")

@section("content")
    <div class="container position-absolute top-50 start-50 translate-middle list-group text-center">
        <a class="list-group-item list-group-item-action active bg-info border-0" aria-current="true"><h2>
                Administracion del
                bibliotecario</h2></a>
        <b class="list-group-item list-group-item-action bg-dark text-light ">Nombre de usuario: {{$_SESSION["usuario"]["username"]}} </b>
        <a class="list-group-item list-group-item-action bg-dark text-light " href="autores/index.php"> Autores </a>
        <a class="list-group-item list-group-item-action bg-dark text-light" href="categorias/index.php"> Categorias </a>
        <a class="list-group-item list-group-item-action bg-dark text-light " href="editoriales/index.php"> Editoriales </a>
        <a class="list-group-item list-group-item-action bg-dark text-light " href="libros/index.php"> Libros </a>
        <a class="list-group-item list-group-item-action bg-dark text-light " href="prestamos/index.php"> Prestamos </a>
        <a class="list-group-item list-group-item-action bg-dark text-light" href="sanciones/index.php"> Sanciones </a>
        <a class="list-group-item list-group-item-action bg-dark text-light" href="usuarios/index.php"> Usuarios </a>
    </div>

@endsection
