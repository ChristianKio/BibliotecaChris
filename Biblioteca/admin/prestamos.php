<?php
session_start();
require "DB.php";
if (isset($_SESSION["usuario"])) {
    $libro = $_GET["id"];
    $usuario = $_SESSION["usuario"]["id"];
    $fecha_prestamo = date("Y-m-d");
    $fecha_devolucion = date("Y-m-d", strtotime($fecha_prestamo . "+ 1 week"));
    $miConsulta = $miPDO->prepare(" SELECT * FROM prestamos WHERE usuario LIKE (:usuario)");
    $miConsulta->execute(
        [
            "usuario" => $usuario
        ]
    );
    $prestamo = $miConsulta->fetchAll();
    $cantidad = count($prestamo);
    if ($cantidad < 2 ) {
        $miInsert = $miPDO->prepare
        ("INSERT INTO prestamos (libro, usuario, fecha_prestamo, fecha_devolucion, estado) 
        VALUES (:libro, :usuario, :fecha_prestamo, :fecha_devolucion, :estado);");
        $miInsert->execute
        (
            [
                "libro" => $libro,
                "usuario" => $usuario,
                "fecha_prestamo" => $fecha_prestamo,
                "fecha_devolucion" => $fecha_devolucion,
                "estado" => '1',
            ]
        );
        header("location:../index.php?true=agregado");
    } else {
        header("location:../index.php?false=denegado");
    }

} else {
    header("location:../index.php?sesion=cerrada");
}