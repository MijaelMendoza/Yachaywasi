<?php include '../templates/header.php'; ?>

<?php
require_once '../../../backend/controllers/clientController.php';

$clienteController = new ClienteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'agregar') {
        $clienteController->crearCliente($_POST);
    } elseif (isset($_POST['accion']) && $_POST['accion'] === 'eliminar') {
        $clienteController->eliminarCliente($_POST['cu']);
    }
    header('Location: clientePage.php');
    exit();
}


$jsonClientes = $clienteController->listarClientes();
$clientes = json_decode($jsonClientes, true);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes</title>
</head>

<body>
    <h1>Listado de Clientes</h1>
    <?php if (is_array($clientes) && count($clientes) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>CU</th>
                    <th>Nombre</th>
                    <th>CI</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Fecha de Registro</th>
                    <th>Segmento de Cliente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['cu']) ?></td>
                        <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                        <td><?= htmlspecialchars($cliente['ci']) ?></td>
                        <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                        <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                        <td><?= htmlspecialchars($cliente['correo']) ?></td>
                        <td><?= htmlspecialchars($cliente['fecha_registro']) ?></td>
                        <td><?= htmlspecialchars($cliente['segmento_cliente']) ?></td>
                        <td>
                            <form action="clientePage.php" method="post">
                                <input type="hidden" name="accion" value="eliminar">
                                <input type="hidden" name="cu" value="<?= $cliente['cu'] ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        <td>
                            <a href="editarCliente.php?cu=<?= urlencode($cliente['cu']) ?>">Editar</a>
                        </td>

                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php else: ?>
        <p>No hay clientes registrados.</p>
    <?php endif; ?>
</body>

</html>

<?php include '../templates/footer.php'; ?>