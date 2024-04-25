<?php include '../templates/header.php'; ?>
<?php
require_once '../../../backend/controllers/clientController.php';

$clienteController = new ClienteController();
$cliente = null;

if (isset($_GET['cu'])) {
    $jsonCliente = $clienteController->mostrarCliente($_GET['cu']);
    $cliente = json_decode($jsonCliente, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar') {
        $clienteController->actualizarCliente($_POST['cu'], $_POST);
        header('Location: clientePage.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>

<body>
    <h1>Editar Cliente</h1>
    <?php if ($cliente): ?>
        <form action="editarCliente.php" method="post">
            <input type="hidden" name="accion" value="actualizar">
            <input type="hidden" name="cu" value="<?= htmlspecialchars($cliente['cu']) ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required><br>

            <label for="ci">CI:</label>
            <input type="text" name="ci" id="ci" value="<?= htmlspecialchars($cliente['ci']) ?>" required><br>

            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($cliente['direccion']) ?>"
                required><br>

            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>"
                required><br>

            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" value="<?= htmlspecialchars($cliente['correo']) ?>" required><br>

            <label for="fecha_registro">Fecha de Registro:</label>
            <input type="date" name="fecha_registro" id="fecha_registro"
                value="<?= htmlspecialchars($cliente['fecha_registro']) ?>" required><br>

            <label for="segmento_cliente">Segmento de Cliente:</label>
            <input type="text" name="segmento_cliente" id="segmento_cliente"
                value="<?= htmlspecialchars($cliente['segmento_cliente']) ?>" required><br>

            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="1" <?= $cliente['estado'] ? 'selected' : '' ?>>Activo</option>
                <option value="0" <?= !$cliente['estado'] ? 'selected' : '' ?>>Inactivo</option>
            </select><br>

            <button type="submit">Actualizar Cliente</button>
        </form>

    <?php else: ?>
        <p>Cliente no encontrado.</p>
    <?php endif; ?>
</body>

</html>

<?php include '../templates/footer.php'; ?>