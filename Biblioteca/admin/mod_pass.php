<?php
session_start();
require "../vendor/autoload.php";
require "DB.php";

use eftec\bladeone\BladeOne;

$views = '../views';
$cache = '../cache';

$blade = new BladeOne($views, $cache);

$id = $_REQUEST['id'] ?? null;
$password = $_REQUEST['password'] ?? null;
$options = array("cost" => 4);
$hashPassword = password_hash($password, PASSWORD_BCRYPT, $options);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $miUpdate = $miPDO->prepare('UPDATE usuarios SET password = :password WHERE id = :id');

    $miUpdate->execute(
        [
            'id' => $id,
            'password' => $hashPassword
        ]
    );
    session_destroy();
    header('Location: ../Sesion/login.php');
} else {
    $miConsulta = $miPDO->prepare('SELECT * FROM usuarios WHERE id = :id;');
    $miConsulta->execute(
        [
            'id' => $id
        ]
    );
}
$_SESSION["usuario"]["password"] = $hashPassword;

$usuarios = $miConsulta->fetch();

try {
    echo $blade->run("dashboard.updatepass",
        [
            "usuarios" => $usuarios,
            "id" => $id
        ]);
} catch (Exception $e) {
}
