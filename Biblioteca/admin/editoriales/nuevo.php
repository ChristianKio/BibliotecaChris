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
    $miInsert = $miPDO->prepare("INSERT INTO editoriales (nombre) VALUES (:nombre);");
    $miInsert->execute(
        [
            "nombre" => $nombre
        ]
    );
    $_SESSION["mensaje"] = "Registro añadido correctamente.";
    header("Location: index.php");

}
try {
    echo $blade->run("editoriales.nuevo", []);
} catch (Exception $e) { }