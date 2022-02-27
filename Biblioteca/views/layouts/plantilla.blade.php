<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fe280c8931.js"></script>
    <link rel="stylesheet" href="../../css/estilos.css">
    <title>Biblioteca</title>
</head>

<body>

<div class="container">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">BiblioChristian</span>
            </a>

            <nav class="d-inline-flex mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-light text-decoration-none btn btn-primary btn-sm" href="index.php">Inicio</a>
                @if (isset($_SESSION["usuario"]))
                    <div class="dropdown">
                        <button class="me-3 py-2 text-light text-decoration-none btn-dark btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown"
                                id="dropdownMenu"> {{$_SESSION["usuario"]["username"]}} </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                            <li><a class="dropdown-item"
                                   href="admin/dashboard.php?id={{$_SESSION["usuario"]["id"]}}">Perfil</a></li>

                            @if ($_SESSION["usuario"]["tipo"] === "bibliotecario")
                                <li><a class="dropdown-item" href="admin/index.php?id={{$_SESSION["usuario"]["id"]}}">Administracion</a>
                                </li>
                            @endif
                            <li><a class="dropdown-item" href="Sesion/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                @else
                    <a class="me-3 py-2 text-light text-decoration-none btn btn-primary btn-sm"
                       href="Sesion/login.php">Login</a>
                @endif
            </nav>
        </div>
    </header>

    <div class="row">
        <h1 class="text-center border-bottom pb-4 mb-4">Libros</h1>
        @if (isset($_GET['true']) == "prestado")
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                El prestamo se ha efectuado correctamente <strong>exitosamente!</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (isset($_GET['false']) == "denegado")
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                El prestamo se ha <strong>denegado!</strong><br>
                Tiene 2 libros prestados, devuelva alguno si desea pedir prestado otro libro.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (isset($_GET['sesion']) == "cerrada")
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong> Inicie sesion </strong> para pedir un libro prestrado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</div>


</body>
</html>
