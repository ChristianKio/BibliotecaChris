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

$sql = ' SELECT p.*, 
                    libros.titulo as libro,
                    usuarios.username as usuario
        FROM prestamos p
        LEFT JOIN libros ON p.libro = libros.id
        LEFT JOIN usuarios ON p.usuario = usuarios.id';

$sql2 = $sql . " WHERE libro LIKE CONCAT ( '%' , :libro , '%' )";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    unset($_SESSION["mensaje"]);
    $libro = $_REQUEST["buscar"] ?? null;
    $miConsulta = $miPDO->prepare($sql2);
    $miConsulta->execute(["libro" => $libro]);
} else {
    $miConsulta = $miPDO->query($sql);

}
$prestamos = $miConsulta->fetchAll();


try {
    echo $blade->run("prestamos.index", ["prestamos" => $prestamos]);
} catch (Exception $e) {
}