<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="bg-dark">
<div class="container h-100">
    <div class="row h-100 mt-5 justify-content-center align-items-center">
        <div class="col-md-5 mt-5 pt-2 pb-5 align-self-center border bg-light">
            <h1 class="mx-auto w-25">Login</h1>
            @if (isset ($errors) && count($errors) > 0)
                @foreach ($errors as $error_msg)
                    <div class="alert alert-danger"> {{$error_msg}} </div>
                @endforeach
            @endif

            <form method="POST" action="{{$_SERVER['PHP_SELF']}}">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input id="username" type="text" name="username" placeholder="Introduzca un nombre de usuario" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input id="password" type="password" name="password" placeholder="Introduzca una contraseña:" class="form-control">
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Conectarse</button>
                <a href="register.php" class="btn btn-primary">Registrarse</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>