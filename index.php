<<<<<<< HEAD
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    header("Location: ./frontend/views/homePage/homePage.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Aquí van los vinculos de Bootstrap o estilos -->
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="post">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required><br>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
=======
<?php include './templates/header.php'; ?>

<div class="container mt-5">
    <h1>Bienvenido a Mi Sitio Web</h1>
    <p>Esta es la página principal del sitio web. Aquí puedes agregar más contenido HTML o PHP como desees.</p>
</div>

<?php include '/templates/footer.php'; ?>
>>>>>>> 0482b201aadd2b2ad2e48d985d0bef4eddc9546a
