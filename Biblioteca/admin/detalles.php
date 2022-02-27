<?php

session_start();
require "../vendor/autoload.php";
require "DB.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';
$blade = new BladeOne($views, $cache);

$id = $_GET["id"];

$sql = ' SELECT l.*, 
                    autores.nombre as autor,
                    categorias.nombre as categoria,
                    editoriales.nombre as editorial
        FROM libros l
        LEFT JOIN autores ON l.autor = autores.id
        LEFT JOIN editoriales ON l.editorial = editoriales.id
        LEFT JOIN categorias ON l.categoria = categorias.id
        WHERE l.id LIKE (:id)';

$miConsulta = $miPDO->prepare($sql);
$miConsulta->execute(
    [
        "id" => $id
    ]
);
$libros = $miConsulta->fetchAll();

try {
    echo $blade->run("detalles", ["libros" => $libros]);
} catch (Exception $e) {
}