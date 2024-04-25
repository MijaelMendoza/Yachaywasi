<?php
require_once './backend/core/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    $conn = Conectarse();
    if ($conn) {
        $stmt = $conn->prepare("SELECT ca, password, cargo, nombre, sucursal_cs FROM Empleado WHERE correo = :correo");
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($password === $user['password']) {
                if ($user['cargo'] === 'Admin') {
                    $_SESSION['user_name'] = $user['nombre'];
                    $_SESSION['user_sucursal'] = $user['sucursal_cs'];
                    $_SESSION['user_id'] = $user['ca'];
                    header("Location: ./frontend/views/homePage/homeAdmin.php");
                } else if ($user['cargo'] === 'Empleado') {
                    header("Location: dashboard_empleado.php");
                }
                exit();
            } else {
                $_SESSION['error_message'] = "Correo o contraseña incorrectos.";
                header("Location: index.php");
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Usuario no encontrado.";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "No se pudo establecer conexión con la base de datos.";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./frontend/css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="log">
    <div class="conta">
        <div class="borde"><b>Login</b></div> <br>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div style="color: red;"><?php echo $_SESSION['error_message']; ?></div>
            <?php unset($_SESSION['error_message']); ?> 
        <?php endif; ?>
        <form method="post">
            <label for="username">
                <i class="fas fa-user icon"></i>
            </label>
            <input type="text" name="correo" placeholder="Correo" id="correo" required><br>
            <div class="show-password">
                <label for="password">
                    <i class="fas fa-lock icon"></i>
                </label>
                <input type="password" name="password" placeholder="Contraseña" id="password" required>
                <i class="far fa-eye" onclick="togglePasswordVisibility()"></i>
            </div>
            
            <input type="submit" value="Acceder">
            <br>
            <small><a href="#">Recuperar contraseña</a></small>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.querySelector(".show-password i:last-child");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.remove("far", "fa-eye");
                eyeIcon.classList.add("far", "fa-eye-slash");
            } else {
                passwordField.type = "password";
                eyeIcon.classList.remove("far", "fa-eye-slash");
                eyeIcon.classList.add("far", "fa-eye");
            }
        }
    </script>
</body>
</html>