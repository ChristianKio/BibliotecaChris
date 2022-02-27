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
$apellidos = $_REQUEST["apellidos"] ?? null;
$foto = $_REQUEST["foto"] ?? null;
$fecha_nacimiento = $_REQUEST["fecha_nacimiento"] ?? null;
$fecha_fallecimiento = $_REQUEST["fecha_fallecimiento"] ?? null;
$lugar_nacimiento = $_REQUEST["lugar_nacimiento"] ?? null;
$biografia = $_REQUEST["biografia"] ?? null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $foto = $_FILES['foto']['name'];
    $tipos = $_FILES['foto']['type'];
    $tamano = $_FILES['foto']['size'];

    if (!empty($foto) && ($_FILES['foto']['size'] <= 200000000)) {
        if (($_FILES["foto"]["type"] === "image/gif")
            || ($_FILES["foto"]["type"] === "image/jpeg")
            || ($_FILES["foto"]["type"] === "image/jpg")
            || ($_FILES["foto"]["type"] === "image/png")) {
            $directorio = '../../imagenes/autores/';
            move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $foto);
            $miUpdate = $miPDO->prepare("UPDATE autores SET nombre = :nombre, apellidos = :apellidos, foto = :foto, 
                  fecha_nacimiento = :fecha_nacimiento, fecha_fallecimiento = :fecha_fallecimiento, lugar_nacimiento = :lugar_nacimiento,  biografia = :biografia WHERE id = :id;");
            $miUpdate->execute(
                [
                    "id" => $id,
                    "nombre" => $nombre,
                    "apellidos" => $apellidos,
                    "foto" => $foto,
                    "fecha_nacimiento" => $fecha_nacimiento,
                    "fecha_fallecimiento" => $fecha_fallecimiento,
                    "lugar_nacimiento" => $lugar_nacimiento,
                    "biografia" => $biografia

                ]
            );
        } else {
            echo "No se puede subir una imagen con ese formato ";
        }
    } else if ($foto === !NULL) {
        echo "La imagen es demasiado grande ";
    } else {
        $miUpdate = $miPDO->prepare("UPDATE usuarios SET nombre = :nombre, apellido = :apellido, 
                  email = :email, username = :username, password = :password, tipo = :tipo, activo = :activo WHERE id = :id;");
        $miUpdate->execute(
            [
                "id" => $id,
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "fecha_nacimiento" => $fecha_nacimiento,
                "fecha_fallecimiento" => $fecha_fallecimiento,
                "lugar_nacimiento" => $lugar_nacimiento,
                "biografia" => $biografia
            ]
        );
    }
    $_SESSION["mensaje"] = "Registro modificado correctamente.";
    header("Location: index.php");
} else {
    $miConsulta = $miPDO->prepare("SELECT * FROM autores WHERE id = :id;");
    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}

$autores = $miConsulta->fetch();

try {
    echo $blade->run("autores.modificar", [ "autores" => $autores ]);
} catch (Exception $e) {
}