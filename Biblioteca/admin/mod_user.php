<?php
session_start();
require "../vendor/autoload.php";
require "DB.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';

$blade = new BladeOne($views, $cache);

$id = $_REQUEST['id'] ?? null;
$nombre = trim($_POST["nombre"]);
$apellido = trim($_POST["apellido"]);
$username = trim($_POST["username"]);
$avatar = trim($_POST["avatar"]);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $avatar = $_FILES["avatar"]["name"];
    $tipos = $_FILES["avatar"]["type"];
    $tamano = $_FILES["avatar"]["size"];

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
    $miUpdate = $miPDO->prepare('UPDATE usuarios SET nombre = :nombre,apellido = :apellido ,username = :username, avatar = :avatar WHERE id = :id');

    $miUpdate->execute(
        [
            'id' => $id,
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":username" => $username,
            ":avatar" => $avatar
        ]
    );
    session_destroy();
    header('Location: ../Sesion/login.php');
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM usuarios WHERE id = :id;');
    $miConsulta->execute(
        [
            'id' => $id
        ]
    );
}
$_SESSION["usuario"]["nombre"] = $nombre;
$_SESSION["usuario"]["apellido"] = $apellido;
$_SESSION["usuario"]["username"] = $username;
$_SESSION["usuario"]["avatar"] = $avatar;

$usuarios = $miConsulta->fetch();

try {
    echo $blade->run("dashboard.updateuser",
        [
            "usuarios" => $usuarios,
            "id" => $id
        ]);
} catch (Exception $e) {
}