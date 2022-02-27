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
    $titulo = $_REQUEST["titulo"] ?? null;
    $autor = $_REQUEST["autor"] ?? null;
    $editorial = $_REQUEST["editorial"] ?? null;
    $imagen = $_REQUEST["imagen"] ?? null;
    $categoria = $_REQUEST["categoria"] ?? null;
    $sinopsis= $_REQUEST["sinopsis"] ?? null;
    $disponibilidad = $_REQUEST["disponibilidad"] ?? null;


    $imagen = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];

    if (!empty($imagen) && ($_FILES['imagen']['size'] <= 200000000)) {
        if (($_FILES["imagen"]["type"] === "image/gif")
            || ($_FILES["imagen"]["type"] === "image/jpeg")
            || ($_FILES["imagen"]["type"] === "image/jpg")
            || ($_FILES["imagen"]["type"] === "image/png"))
        {
            $directorio = '../../imagenes/libros/';
            move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$imagen);
        }
        else
        {
            echo "No se puede subir una imagen con ese formato ";
        }
    } else if($imagen === !NULL) {
        echo "La imagen es demasiado grande ";
    }

    $miInsert = $miPDO->prepare("INSERT INTO libros (titulo, autor, editorial, imagen, categoria, sinopsis ,disponibilidad) 
VALUES (:titulo, :autor, :editorial, :imagen, :categoria, sinopsis, :disponibilidad);");
    $miInsert->execute(
        [
            "titulo" => $titulo,
            "autor" => $autor,
            "editorial" => $editorial,
            "imagen" => $imagen,
            "categoria" => $categoria,
            "disponibilidad" => $disponibilidad
        ]
    );
    $_SESSION["mensaje"] = "Registro añadido correctamente.";
    header("Location: index.php");

}

$MiConsulta = $miPDO-> query("Select * from autores;");
$autores = $MiConsulta->fetchAll();

$MiConsulta = $miPDO-> query("Select * from editoriales;");
$editoriales = $MiConsulta->fetchAll();

$MiConsulta = $miPDO-> query("Select * from categorias;");
$categorias = $MiConsulta->fetchAll();
try {
    echo $blade->run("libros.nuevo", ["editoriales" => $editoriales,
        "categorias" => $categorias, "autores" => $autores]);
} catch (Exception $e) { }