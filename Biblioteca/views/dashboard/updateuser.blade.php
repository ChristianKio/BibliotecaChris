<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro</title>
</head>

<body class="bg-dark">
<div class="container h-100">
    <div class="row h-100 mt-5 justify-content-center align-items-center">
        <div class="col-md-5 mt-3 pt-2 pb-5 align-self-center border bg-light">
            <h1 class="mx-auto w-50">Cambiar datos</h1>
            <form method="POST" action="{{$_SERVER['PHP_SELF']}}" enctype="multipart/form-data">
                <div class="form-group align">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" placeholder="Introduce tu nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" placeholder="Introduce tu apellido"
                           class="form-control">
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Introduce tu nombre de usuario"
                           class="form-control">

                </div>


                <div class="form-group">
                    <label for="avatar">Avatar:</label>
                    <input class="form-control" type="file" name="avatar">
                </div>
                <br>
                <button type="submit" id="submit" name="submit" class="btn btn-primary">Registrarse</button>
                <br>
                <p class="pt-2"> Volver al <a href="dashboard.php">DashBoard</a></p>

            </form>
        </div>
    </div>
</div>
</body>
</html>