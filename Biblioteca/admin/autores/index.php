<?php
session_start();
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    unset($_SESSION["mensaje"]);
    $nombre = $_REQUEST["buscar"] ?? null;
    $miConsulta = $miPDO->prepare(" SELECT * FROM autores WHERE nombre LIKE CONCAT ( '%' , :nombre , '%' ); ");
    $miConsulta->execute(["nombre" => $nombre]);
} else {
    $miConsulta = $miPDO->query("SELECT * FROM autores;");

}
$autores = $miConsulta->fetchAll();

try {
    echo $blade->run("autores.index", ["autores" => $autores]);
} catch (Exception $e) {
}