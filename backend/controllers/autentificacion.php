<?php
session_start(); 


function Conectarse()
{
    $link = mysqli_connect("localhost", "root", "", "yachaywasi");

    
    if (mysqli_connect_errno()) {
        echo "<H1>Error en la conexión a la base de datos: " . mysqli_connect_error() . "</H1>";
        exit();
    }

    return $link; 
}
$link = Conectarse(); 

$correo = $_POST['correo'];
$password_form = $_POST['password']; 

$consulta = "SELECT correo, password, cargo FROM Empleado WHERE correo = '$correo'";

$resultado = mysqli_query($link, $consulta);

if ($resultado) {
    
    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        
        echo "Cargo de la fila: " . $fila['cargo'] . "<br>";
        echo "Contraseña de la fila: " . $fila['password'] . "<br>";
        echo "Contraseña del formulario: " . $password_form . "<br>";
        
        if ($fila['cargo'] === 'admin' && $fila['password'] === $password_form) {
            header('Location: ejemplo.html');
            exit(); 
        } else {
            
            $_SESSION['error_message'] = "El correo o contraseña no son correctos";
            header('Location: index.php'); 
            exit(); 
        }
    } else {
        $_SESSION['error_message'] = "El correo o contraseña no son correctos";
        header('Location: index.php'); 
        exit(); 
    }
} else {
    echo "Error en la consulta.";
}
?>
