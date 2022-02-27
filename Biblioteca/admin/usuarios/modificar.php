<?php
session_start();
unset($_SESSION["mensaje"]);
require "../../vendor/autoload.php";
require "../DB.php";

use eftec\bladeone\BladeOne;

$views = "../../views";
$cache = "../../cache";
$blade = new BladeOne($views, $cache);

if (empty($_SESSION) || $_SESSION["usuario"]["tipo"] != "bibliotecario") {
    header('refresh:3;url=../index.php');
    die("Usuario no autorizado");
}

$id = $_REQUEST["id"] ?? null;
$nombre = $_REQUEST["nombre"] ?? null;
$apellido = $_REQUEST["apellido"] ?? null;
$email = $_REQUEST["email"] ?? null;
$username = $_REQUEST["username"] ?? null;
$password = $_REQUEST["password"] ?? null;
$avatar = $_REQUEST["avatar"] ?? null;
$tipo = $_REQUEST["tipo"] ?? null;
$activo = $_REQUEST["activo"] ?? null;

$options = array("cost" => 4);
$hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $avatar = $_FILES['avatar']['name'];
    $tipos = $_FILES['avatar']['type'];
    $tamano = $_FILES['avatar']['size'];

    if (!empty($avatar) && ($_FILES['avatar']['size'] <= 200000000)) {
        if (($_FILES["avatar"]["type"] === "image/gif")
            || ($_FILES["avatar"]["type"] === "image/jpeg")
            || ($_FILES["avatar"]["type"] === "image/jpg")
            || ($_FILES["avatar"]["type"] === "image/png")) {
            $directorio = '../../imagenes/usuarios/';
            move_uploaded_file($_FILES['avatar']['tmp_name'], $directorio . $avatar);
            $miUpdate = $miPDO->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, 
                  email = :email, username = :username, password = :password, avatar = :avatar, tipo = :tipo, activo = :activo WHERE id = :id;");
            $miUpdate->execute(
                [
                    "id" => $id,
                    "nombre" => $nombre,
                    "apellido" => $apellido,
                    "email" => $email,
                    "username" => $username,
                    "password" => $hashPassword,
                    "avatar" => $avatar,
                    "tipo" => $tipo,
                    "activo" => $activo
                ]
            );
        } else {
            echo "No se puede subir una imagen con ese formato ";
        }
    } else if ($avatar === !NULL) {
        echo "La imagen es demasiado grande ";
    } else {
        $miUpdate = $miPDO->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, 
                  email = :email, username = :username, password = :password, tipo = :tipo, activo = :activo WHERE id = :id;");
        $miUpdate->execute(
            [
                "id" => $id,
                "nombre" => $nombre,
                "apellido" => $apellido,
                "email" => $email,
                "username" => $username,
                "password" => $hashPassword,
                "tipo" => $tipo,
                "activo" => $activo
            ]
        );
    }

    $_SESSION["mensaje"] = "Registro modificado correctamente.";
    header("Location: index.php");
} else {

    $miConsulta = $miPDO->prepare("SELECT * FROM usuarios WHERE id = :id;");
    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}

$usuarios = $miConsulta->fetch();

try {
    echo $blade->run("usuarios.modificar", ["usuarios" => $usuarios]);
} catch (Exception $e) {
}