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
    $apellidos = $_REQUEST["apellidos"] ?? null;
    $foto = $_REQUEST["foto"] ?? null;
    $fecha_nacimiento = $_REQUEST["fecha_nacimiento"] ?? null;
    $fecha_fallecimiento = $_REQUEST["fecha_fallecimiento"] ?? null;
    $lugar_nacimiento = $_REQUEST["lugar_nacimiento"] ?? null;
    $biografia = $_REQUEST["biografia"] ?? null;



    $foto = $_FILES['foto']['name'];
    $tipo = $_FILES['foto']['type'];
    $tamano = $_FILES['foto']['size'];

    if (!empty($foto) && ($_FILES['foto']['size'] <= 200000000)) {
        if (($_FILES["foto"]["type"] === "image/gif")
            || ($_FILES["foto"]["type"] === "image/jpeg")
            || ($_FILES["foto"]["type"] === "image/jpg")
            || ($_FILES["foto"]["type"] === "image/png"))
        {
            $directorio = '../../imagenes/autores/';
            move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$foto);
        }
        else
        {
            echo "No se puede subir una foto con ese formato ";
        }
    } else if($foto === !NULL) {
        echo "La imagen es demasiado grande ";
    }

    $miInsert = $miPDO->prepare("INSERT INTO autores (nombre, apellidos, fecha_nacimiento, fecha_fallecimiento, lugar_nacimiento, biografia, foto) 
VALUES (:nombre, :apellidos, :fecha_nacimiento, :fecha_fallecimiento, :lugar_nacimiento, :biografia, :foto);");
    $miInsert->execute(
        [
            "nombre" => $nombre,
            "apellidos" => $apellidos,
            "fecha_nacimiento" => $fecha_nacimiento,
            "fecha_fallecimiento" => $fecha_fallecimiento,
            "lugar_nacimiento" => $lugar_nacimiento,
            "biografia" => $biografia,
            "foto" => $foto,
        ]
    );
    $_SESSION["mensaje"] = "Registro añadido correctamente.";
    header("Location: index.php");

}
try {
    echo $blade->run("autores.nuevo", []);
} catch (Exception $e) { }