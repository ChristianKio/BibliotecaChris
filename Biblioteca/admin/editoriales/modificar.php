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


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $miUpdate = $miPDO->prepare("UPDATE editoriales SET nombre = :nombre WHERE id = :id;");
    $miUpdate->execute(
        [
            "id" => $id,
            "nombre" => $nombre
        ]
    );
    $_SESSION["mensaje"] = "Registro modificado correctamente.";
    header("Location: index.php");
} else {
    $miConsulta = $miPDO->prepare("SELECT * FROM editoriales WHERE id = :id;");
    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}

$editoriales = $miConsulta->fetch();

try {
    echo $blade->run("editoriales.modificar", [ "editoriales" => $editoriales ]);
} catch (Exception $e) {
}