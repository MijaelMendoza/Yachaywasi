<?php 
$host = 'localhost';
$usuario = 'postgres';
$contrasena = '3211';
$nombre_bd = 'yachaywasi';
try {
    $conn = @new PDO("pgsql:host=$host;dbname=$nombre_bd;user=$usuario;password=$contrasena");
} catch (Exception $e) {
    echo "sdsa";
    echo $e->getMessage();
}



return $conn;
?>