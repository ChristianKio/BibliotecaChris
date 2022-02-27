<?php
session_start();
require "../vendor/autoload.php";
require "DB.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';
$blade = new BladeOne($views, $cache);

if (empty($_SESSION) || $_SESSION["usuario"]["tipo"] != "bibliotecario") {
    header('refresh:3;url=../index.php');
    die("Usuario no autorizado");
}

try {
    echo $blade->run("indexadmin", []);
} catch (Exception $e) {
}