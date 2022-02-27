<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fe280c8931.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/estilos.css">
    <title>Biblioteca</title>
</head>
<body>
<div class="container">
    <header>
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            <a href="../../index.php" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">BiblioChristian</span>
            </a>

            <nav class="d-inline-flex mt-md-0 ms-md-auto">
                <a class="me-3 py-2 text-light text-decoration-none btn btn-primary btn-sm" href="../../index.php">Inicio</a>
                @if (isset($_SESSION["usuario"]))
                    <div class="dropdown">
                        <button class="me-3 py-2 text-light text-decoration-none btn-dark btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown"
                                id="dropdownMenu"> {{$_SESSION["usuario"]["username"]}} </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenu">
                            @if ($_SESSION["usuario"]["tipo"] === "bibliotecario")
                                <li><a class="dropdown-item" href="../dashboard2.php?id={{$_SESSION["usuario"]["id"]}}">Perfil</a></li>
                            @else
                                <li><a class="dropdown-item" href="../dashboard.php?id={{$_SESSION["usuario"]["id"]}}">Perfil</a></li>
                            @endif
                            @if ($_SESSION["usuario"]["tipo"] === "bibliotecario")
                                <li><a class="dropdown-item" href="../index.php?id={{$_SESSION["usuario"]["id"]}}">Administracion</a></li>
                            @endif
                            <li><a class="dropdown-item" href="../../Sesion/logout.php">Cerrar sesión</a></li>
                        </ul>
                    </div>
                @else
                    <a class="me-3 py-2 text-light text-decoration-none btn btn-primary btn-sm"
                       href="../../Sesion/login.php">Login</a>
                @endif
            </nav>
        </div>
    </header>
    <div class="row">
    @if (isset($_SESSION["mensaje"]))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ $_SESSION["mensaje"] }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @unset($_SESSION["mensaje"])
    @endif
    </div>
    @yield('Encabezado')
    <table class="table table-striped table-bordered">
        @yield('tabla')
    </table>
</div>
</body>
</html>
