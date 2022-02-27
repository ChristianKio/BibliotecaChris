<?php
$Host = 'localhost';
$DB = 'biblioteca';
$Usuario = 'root';
$Pass = '1234';

try {
    $dns = "mysql:host=$Host;dbname=$DB;";

    $miPDO = new PDO($dns, $Usuario, $Pass);

    $miPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $error) {
    echo "Error: " . $error->getMessage();
    die();
}