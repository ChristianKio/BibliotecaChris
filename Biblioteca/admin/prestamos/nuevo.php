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
    $libro = $_REQUEST["libro"] ?? null;
    $usuario = $_REQUEST["usuario"] ?? null;
    $fecha_prestamo = $_REQUEST["fecha_prestamo"] ?? null;
    $fecha_devolucion = $_REQUEST["fecha_devolucion"] ?? null;
    $estado = $_REQUEST["estado"] ?? null;

    $miInsert = $miPDO->prepare
    ("INSERT INTO prestamos (libro, usuario, fecha_prestamo, fecha_devolucion, estado) 
     VALUES (:libro, :usuario, :fecha_prestamo, :fecha_devolucion, :estado);");
    $miInsert->execute(
        [
            "libro" => $libro,
            "usuario" => $usuario,
            "fecha_prestamo" => $fecha_prestamo,
            "fecha_devolucion" => $fecha_devolucion,
            "estado" => $estado
        ]
    );
    $_SESSION["mensaje"] = "Registro añadido correctamente.";
    header("Location: index.php");

}

$MiConsulta = $miPDO-> query("Select * from usuarios;");
$usuarios = $MiConsulta->fetchAll();

$MiConsulta = $miPDO-> query("Select * from libros;");
$libros = $MiConsulta->fetchAll();


try {
    echo $blade->run("prestamos.nuevo", ["usuarios" => $usuarios,
        "libros" => $libros]);
} catch (Exception $e) {
}