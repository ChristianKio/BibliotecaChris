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

$sql = "SELECT l.*, 
               autores.nombre as autor, 
               editoriales.nombre as editorial, 
               categorias.nombre as categoria
        FROM libros l
        LEFT JOIN autores ON l.autor = autores.id
        LEFT JOIN editoriales ON l.editorial = editoriales.id
        LEFT JOIN categorias ON l.categoria = categorias.id";

$sql2 = $sql . " WHERE titulo LIKE CONCAT ( '%' , :titulo , '%' )  ";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    unset($_SESSION["mensaje"]);
    $titulo = $_REQUEST["buscar"] ?? null;
    $miConsulta = $miPDO->prepare($sql2) ;
    $miConsulta->execute(["titulo" => $titulo]);
} else {
    $miConsulta = $miPDO->query($sql);

}
$libros = $miConsulta->fetchAll();


try {
    echo $blade->run("libros.index", ["libros" => $libros]);
} catch (Exception $e) {
}