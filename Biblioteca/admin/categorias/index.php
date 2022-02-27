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
    $miConsulta = $miPDO->prepare(" SELECT * FROM categorias WHERE nombre LIKE CONCAT ( '%' , :nombre , '%' ); ");
    $miConsulta->execute(["nombre" => $nombre]);
} else {
    $miConsulta = $miPDO->query("SELECT * FROM categorias;");

}
$categorias = $miConsulta->fetchAll();

try {
    echo $blade->run("categorias.index", ["categorias" => $categorias]);
} catch (Exception $e) {
}