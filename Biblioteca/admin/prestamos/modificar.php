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
$libro = $_REQUEST["libro"] ?? null;
$usuario = $_REQUEST["usuario"] ?? null;
$fecha_prestamo = $_REQUEST["fecha_prestamo"] ?? null;
$fecha_devolucion = $_REQUEST["fecha_devolucion"] ?? null;
$estado = $_REQUEST["estado"] ?? null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {


        $miUpdate = $miPDO->prepare("UPDATE prestamos SET libro = :libro, usuario = :usuario, 
                  fecha_prestamo = :fecha_prestamo, fecha_devolucion = :fecha_devolucion, estado = :estado WHERE id = :id;");
        $miUpdate->execute(
            [
                "id" => $id,
                "libro" => $libro,
                "usuario" => $usuario,
                "fecha_prestamo" => $fecha_prestamo,
                "fecha_devolucion" => $fecha_devolucion,
                "estado" => $estado
            ]
        );

    $_SESSION["mensaje"] = "Registro modificado correctamente.";
    header("Location: index.php");
} else {

    $miConsulta = $miPDO->prepare("SELECT * FROM prestamos WHERE id = :id;");
    $miConsulta->execute(
        [
            "id" => $id
        ]
    );
}

$prestamos = $miConsulta->fetch();

$MiConsulta = $miPDO-> query("Select * from usuarios;");
$usuarios = $MiConsulta->fetchAll();

$MiConsulta = $miPDO-> query("Select * from libros;");
$libros = $MiConsulta->fetchAll();

try {
    echo $blade->run("prestamos.modificar", ["prestamos" => $prestamos, "usuarios" => $usuarios,
        "libros" => $libros]);
} catch (Exception $e) {
}