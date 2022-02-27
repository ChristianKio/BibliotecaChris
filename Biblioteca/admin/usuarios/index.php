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
    $username = $_REQUEST["buscar"] ?? null;
    $miConsulta = $miPDO->prepare(" SELECT * FROM usuarios WHERE username LIKE CONCAT ( '%' , :username , '%' )  ");
    $miConsulta->execute(["username" => $username]);
} else {
    $miConsulta = $miPDO->query("SELECT * FROM usuarios ;");

}
$usuarios = $miConsulta->fetchAll();


try {
    echo $blade->run("usuarios.index", ["usuarios" => $usuarios]);
} catch (Exception $e) {
}