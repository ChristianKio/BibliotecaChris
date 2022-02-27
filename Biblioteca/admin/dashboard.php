<?php
session_start();
require "../vendor/autoload.php";
require "DB.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';
$blade = new BladeOne($views, $cache);

if (empty($_SESSION)) {
    header('refresh:3;url=../index.php');
    die("Usuario no autorizado");
}

$usuario = $_SESSION["usuario"]["id"];
$stmt = $miPDO->prepare("SELECT * FROM prestamos WHERE usuario LIKE (:usuario)");
$stmt->execute(['usuario' => $usuario]);
$prestamos = $stmt->fetchAll();

try {
    echo $blade->run("dashboard.dashboard", ["prestamos" => $prestamos]);
} catch (Exception $e) {
}