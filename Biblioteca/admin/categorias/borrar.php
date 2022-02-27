<?php
session_start();
unset($_SESSION["mensaje"]);
require "../DB.php";

if (empty($_SESSION) || $_SESSION["usuario"]["tipo"] != "bibliotecario") {
    header('refresh:3;url=../index.php');
    die("Usuario no autorizado");
}

$id = $_REQUEST["id"] ?? null;

$miConsulta = $miPDO->prepare("DELETE FROM categorias WHERE id = :id;");


$miConsulta->execute([
    "id" => $id
]);
$_SESSION["mensaje"] = "Registro eliminado correctamente.";
header("Location: index.php");