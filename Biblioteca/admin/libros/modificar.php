<?php
session_start();
unset($_SESSION["mensaje"]);
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

$id = $_REQUEST["id"] ?? null;
$titulo = $_REQUEST["titulo"] ?? null;
$autor = $_REQUEST["autor"] ?? null;
$editorial = $_REQUEST["editorial"] ?? null;
$imagen = $_REQUEST["imagen"] ?? null;
$categoria = $_REQUEST["categoria"] ?? null;
$sinopsis = $_REQUEST["sinopsis"] ?? null;
$disponibilidad = $_REQUEST["disponibilidad"] ?? null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $imagen = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];

    if (!empty($imagen) && ($_FILES['imagen']['size'] <= 200000000)) {
        if (($_FILES["imagen"]["type"] === "image/gif")
            || ($_FILES["imagen"]["type"] === "image/jpeg")
            || ($_FILES["imagen"]["type"] === "image/jpg")
            || ($_FILES["imagen"]["type"] === "image/png")) {
            $directorio = '../../imagenes/libros/';
            move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $imagen);
            $miUpdate = $miPDO->prepare("UPDATE libros SET titulo = :titulo, autor = :autor, 
                  editorial = :editorial, imagen = :imagen, categoria = :categoria, sinopsis = :sinopsis, disponibilidad = :disponibilidad WHERE id = :id;");
            $miUpdate->execute(
                [
                    "id" => $id,
                    "titulo" => $titulo,
                    "autor" => $autor,
                    "editorial" => $editorial,
                    "imagen" => $imagen,
                    "categoria" => $categoria,
                    "sinopsis" => $sinopsis,
                    "disponibilidad" => $disponibilidad
                ]
            );
        } else {
            echo "No se puede subir una imagen con ese formato ";
        }
    } else if ($imagen === !NULL) {
        echo "La imagen es demasiado grande ";
    } else {
        $miUpdate = $miPDO->prepare("UPDATE libros SET titulo = :titulo, autor = :autor, 
              editorial = :editorial, categoria = :categoria, sinopsis = :sinopsis, disponibilidad = :disponibilidad WHERE id = :id;");
        $miUpdate->execute(
            [
                "id" => $id,
                "titulo" => $titulo,
                "autor" => $autor,
                "editorial" => $editorial,
                "categoria" => $categoria,
                "sinopsis" => $sinopsis,
                "disponibilidad" => $disponibilidad
            ]
        );
    }

    $_SESSION["mensaje"] = "Registro modificado correctamente.";
    header("Location: index.php");
} else {

    $miConsulta = $miPDO->prepare("SELECT * FROM libros WHERE id = :id;");
    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}

$MiConsulta = $miPDO->query("Select * from autores;");
$autores = $MiConsulta->fetchAll();

$MiConsulta = $miPDO->query("Select * from editoriales;");
$editoriales = $MiConsulta->fetchAll();

$MiConsulta = $miPDO->query("Select * from categorias;");
$categorias = $MiConsulta->fetchAll();

$libros = $miConsulta->fetch();

try {
    echo $blade->run("libros.modificar", ["libros" => $libros, "editoriales" => $editoriales,
        "categorias" => $categorias, "autores" => $autores]);
} catch (Exception $e) {
}