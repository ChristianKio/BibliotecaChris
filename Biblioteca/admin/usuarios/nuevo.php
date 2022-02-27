<?php
session_start();
require "../../vendor/autoload.php";
require "../DB.php";
unset($_SESSION["mensaje"]);

use eftec\bladeone\BladeOne;

$views = "../../views";
$cache = "../../cache";
$blade = new BladeOne($views, $cache);

if (empty($_SESSION) || $_SESSION["usuario"]["tipo"] != "bibliotecario") {
    header('refresh:3;url=../index.php');
    die("Usuario no autorizado");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_REQUEST["nombre"] ?? null;
    $apellido = $_REQUEST["apellido"] ?? null;
    $email = $_REQUEST["email"] ?? null;
    $username = $_REQUEST["username"] ?? null;
    $password = $_REQUEST["password"] ?? null;
    $avatar = $_REQUEST["avatar"] ?? null;
    $tipo = $_REQUEST["tipo"] ?? null;
    $activo = $_REQUEST["activo"] ?? null;

    $avatar = $_FILES['avatar']['name'];
    $tipos = $_FILES['avatar']['type'];
    $tamano = $_FILES['avatar']['size'];

    $options = array("cost" => 4);
    $hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);

    if (!empty($avatar) && ($_FILES['avatar']['size'] <= 200000000)) {
        if (($_FILES["avatar"]["type"] === "image/gif")
            || ($_FILES["avatar"]["type"] === "image/jpeg")
            || ($_FILES["avatar"]["type"] === "image/jpg")
            || ($_FILES["avatar"]["type"] === "image/png")) {
            $directorio = '../../imagenes/usuarios/';
            move_uploaded_file($_FILES['avatar']['tmp_name'], $directorio . $avatar);
        } else {
            echo "No se puede subir una imagen con ese formato ";
        }
    } else if ($avatar === !NULL) {
        echo "La imagen es demasiado grande ";
    }

    $miInsert = $miPDO->prepare
    ("INSERT INTO usuarios (nombre, apellido, email, username, password, avatar, tipo, activo) 
     VALUES (:nombre, :apellido, :email, :username, :password, :avatar, :tipo, :activo);");
    $miInsert->execute(
        [
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
    $_SESSION["mensaje"] = "Registro añadido correctamente.";
    header("Location: index.php");

}

try {
    echo $blade->run("usuarios.nuevo", []);
} catch (Exception $e) {
}