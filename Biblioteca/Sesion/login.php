<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
require "../admin/DB.php";
require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;

$views = "../views";
$cache = "../cache";
$blade = new BladeOne($views, $cache);

if (isset($_POST["submit"])) {
    if (!empty($_POST['username'] && $_POST['password'])) {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $sql = "select * from usuarios where username = :username";
        $handle = $miPDO->prepare($sql);
        $params = ["username" => $username];
        $handle->execute($params);

        if ($handle->rowCount() > 0) {
            $getRow = $handle->fetch(PDO::FETCH_ASSOC);
            unset($getRow["password"]);
            $_SESSION["usuario"] = $getRow;
            if ($_SESSION["usuario"]["activo"] === 0) {
                $errors[] = "El usuario esta inactivo o dado de baja, 
                comuniquese con el administrador para darse de alta o activar su cuenta de usuario.";
                unset($_SESSION["usuario"]);
            } else {
                header("Location:../index.php");
            }
        } else {
            $errors[] = "Username o contraseña incorrecta";
        }
    } else {
        $errors[] = "El nombre de usuario y la contraseña es necesario";
    }
}

try {
    echo $blade->run("sesion.login", ["errors" => $errors]);
} catch (Exception $e) {
}
