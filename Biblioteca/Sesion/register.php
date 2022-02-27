<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
unset($_SESSION["usuario"]);
require "../admin/DB.php";
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = "../views";
$cache = "../cache";
$blade = new BladeOne($views, $cache);

if (isset($_POST["submit"])) {
    if(!empty($_POST['nombre'] && $_POST['apellido'] && $_POST['email'] && $_POST['username'] && $_POST['password'])) {

        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $email = trim($_POST["email"]);
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $avatar = trim($_POST["avatar"]);
        $tipo = trim($_POST["tipo"]);
        $activo = trim($_POST["activo"]);

        $avatar = $_FILES["avatar"]["name"];
        $tipos = $_FILES["avatar"]["type"];
        $tamano = $_FILES["avatar"]["size"];

        $options = array("cost" => 4);
        $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

        if (!empty($avatar) && ($_FILES["avatar"]["size"] <= 200000000)) {
            if (($_FILES["avatar"]["type"] === "image/gif")
                || ($_FILES["avatar"]["type"] === "image/jpeg")
                || ($_FILES["avatar"]["type"] === "image/jpg")
                || ($_FILES["avatar"]["type"] === "image/png")) {
                $directorio = "../imagenes/usuarios/";
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $directorio . $avatar);
            } else {
                echo "No se puede subir una imagen con ese formato ";
            }
        } else if ($avatar === !NULL) {
            echo "La imagen es demasiado grande ";
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = "select * from usuarios where email = :email";
            $stmt = $miPDO->prepare($sql);
            $p = ["email" => $email];
            $stmt->execute($p);

            if ($stmt->rowCount() === 0) {
                $sql = "INSERT INTO usuarios (nombre, apellido, email, username, password, avatar, tipo, activo) 
			VALUES (:nombre,:apellido,:email, :username,:password,:avatar,:tipo, :activo)";
                try {
                    $handle = $miPDO->prepare($sql);
                    $params = [
                        ":nombre" => $nombre,
                        ":apellido" => $apellido,
                        ":email" => $email,
                        ":username" => $username,
                        ":password" => $hashPassword,
                        ":avatar" => $avatar,
                        ":tipo" => $tipo,
                        ":activo" => $activo
                    ];
                    $handle->execute($params);

                    $success = "Usuario creado correctamente";
                } catch (PDOException $e) {
                    $errors[] = $e->getMessage();

                }
            } else {
                $valNombre = $nombre;
                $valApellido = $apellido;
                $valEmail = "";
                $valUsername = $username;
                $valPassword = $password;
                $errors[] = "El email ya esta registrado";
            }
        } else {
            $errors[] = "El email no es valido";
        }
    } else {
        if (empty($_POST['nombre'])) {
            $errors[] = 'El primer nombre es necesario';
        } else {
            $valNombre = $_POST['nombre'];
        }
        if (empty($_POST['apellido'])) {
            $errors[] = 'El apellido es necesario';
        } else {
            $valApellido = $_POST['apellido'];
        }
        if (empty($_POST['email'])) {
            $errors[] = 'El email es necesario';
        } else {
            $valEmail = $_POST['email'];
        }
        if (empty($_POST['username'])) {
            $errors[] = 'El nombre de usuario es necesario';
        } else {
            $valUsername = $_POST['username'];
        }
        if (empty($_POST['password'])) {
            $errors[] = 'La contraseña es necesaria';
        } else {
            $valPassword = $_POST['password'];
        }
    }
}

try {
    echo $blade->run("sesion.register", ["success" => $success, "errors" => $errors ]);
} catch (Exception $e) {
}
