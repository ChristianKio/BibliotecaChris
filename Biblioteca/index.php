<?php

session_start();
require "vendor/autoload.php";
require "admin/DB.php";

use eftec\bladeone\BladeOne;

$views = 'views';
$cache = 'cache';
$blade = new BladeOne($views, $cache);


$sql = ' SELECT l.*, 
                    autores.nombre as autor,
                    categorias.nombre as categoria,
                    editoriales.nombre as editorial
        FROM libros l
        LEFT JOIN autores ON l.autor = autores.id
        LEFT JOIN editoriales ON l.editorial = editoriales.id
        LEFT JOIN categorias ON l.categoria = categorias.id';

$stmt = $miPDO->query($sql);
$libros = $stmt->fetchAll();

try {
    echo $blade->run("index", ["libros" => $libros]);
} catch (Exception $e) {
}