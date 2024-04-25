<?php
require_once '../../../backend/controllers/librosController.php';
session_start();
$libroController = new LibroController();

$libros = json_decode($libroController->listarLibros(), true);
function logout()
{
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    session_destroy();

    header("Location: ../../../index.php");
    exit();
}

if (isset($_POST['logout'])) {
    logout();
}

include '../templates/header.php';
?>

<style>
    .table-responsive {
        max-height: 700px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .btn-lg img {
        width: 150px;
    }

    .btn-lg {
        width: 100%;
        margin-top: 1rem;
        padding: 1rem;
    }

    .logout-container {
        position: fixed;
        bottom: 50px;
        right: 20px;
    }
</style>


<div class="container mt-5">
    <div class="container mt-5 text-center">
        <h1 class="mb-4">Bienvenido <?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?></h1>

        <div class="row">
            <div class="col">
                <form action="../Registros/registrar_venta.php" method="post">
                    <input type="hidden" name="sucursal"
                        value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#registroVentaModal">
                        <img src="../../images/registro_venta.png" alt="Venta" style="width: 100px;">
                        <div>REGISTRAR VENTA</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_pedido.php" method="post">
                    <input type="hidden" name="sucursal"
                        value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#registroPedidoModal">
                        <img src="../../images/registro_venta.png" alt="Pedido" style="width: 100px;">
                        <div>REGISTRAR PEDIDO</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_ingreso.php" method="post">
                    <input type="hidden" name="sucursal"
                        value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#registroIngresoModal">
                        <img src="../../images/registro_venta.png" alt="Ingreso" style="width: 100px;">
                        <div>REGISTRAR INGRESO</div>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Ventana Modal de Registro de Venta -->
    <div class="modal fade" id="registroVentaModal" tabindex="-1" aria-labelledby="registroVentaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="registroVentaModalLabel">REGISTRAR VENTA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Formulario de registro de ventas -->
                <div class="modal-body">
                    <input type="text" id="buscarLibro" class="form-control mb-3"
                        placeholder="Buscar libro por título...">
                    <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">

                        <!-- Lista de libros disponibles para agregar a la venta -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Libro</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Agregar</th>
                                </tr>
                            </thead>
                            <tbody id="tablaLibros">
                                <?php foreach ($libros as $libro): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($libro['cl']); ?></td>
                                        <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
                                        <td><?php echo htmlspecialchars($libro['precio']); ?></td>
                                        <td><?php echo htmlspecialchars($libro['stock']); ?></td>
                                        <td>
                                            <!-- Botón que cuando se presione añadirá el libro a una lista de compra -->
                                            <input type="number" class="form-control cantidad" min="0" value="0"
                                                style="width: 60px; display: inline-block;">
                                            <button class="btn btn-primary btn-agregar"
                                                data-libro-id="<?php echo htmlspecialchars($libro['cl']); ?>">
                                                Agregar
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <form class="mt-4">
                            <div class="row mb-3">
                                <!-- Campo de Fecha -->
                                <div class="col">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Forma de Pago -->
                                <div class="col">
                                    <label for="formaPago" class="form-label">Forma de Pago</label>
                                    <select class="form-select" id="formaPago">
                                        <option selected>Seleccione...</option>
                                        <option value="1">Efectivo</option>
                                        <option value="2">Tarjeta</option>
                                    </select>
                                </div>
                                <!-- Campo de Nombre del Cliente -->
                                <div class="col">
                                    <label for="nombreCliente" class="form-label">Nombre Cliente</label>
                                    <input type="text" class="form-control" id="nombreCliente"
                                        placeholder="Placeholder">
                                </div>
                            </div>
                            <!-- Lista de libros agregados y monto total -->
                            <div class="mb-3">
                                <label for="librosAgregados" class="form-label">Libros Agregados</label>
                                <ul id="librosAgregados" class="list-group"></ul>
                            </div>
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto Total</label>
                                <input type="text" class="form-control" id="monto" placeholder="Monto Total" readonly>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.btn-agregar').forEach(button => {
            button.addEventListener('click', function () {
                const libroId = this.getAttribute('data-libro-id');
                const titulo = this.closest('tr').cells[1].textContent;
                const precio = parseFloat(this.closest('tr').cells[2].textContent);
                const cantidadInput = this.previousElementSibling;
                const cantidad = parseInt(cantidadInput.value, 10);

                if (cantidad > 0) {
                    const lista = document.getElementById('librosAgregados');
                    const montoInput = document.getElementById('monto');
                    let montoTotal = parseFloat(montoInput.value) || 0;

                    let item = document.createElement('li');
                    item.classList.add('list-group-item');
                    item.innerHTML = `${titulo} - Cantidad: ${cantidad} <button class="btn btn-danger btn-sm remove-item">Quitar</button>`;
                    item.dataset.precio = precio;
                    item.dataset.cantidad = cantidad;

                    lista.appendChild(item);

                    montoTotal += precio * cantidad;
                    montoInput.value = montoTotal.toFixed(2);

                    item.querySelector('.remove-item').addEventListener('click', function () {
                        montoTotal -= item.dataset.precio * item.dataset.cantidad;
                        montoInput.value = montoTotal.toFixed(2);
                        item.remove();
                    });
                } else {
                    alert('Por favor, introduzca una cantidad válida para agregar el libro.');
                }
            });
        });
    </script>

    <script>
        document.getElementById('buscarLibro').addEventListener('input', function () {
            let buscaTexto = this.value.toLowerCase();
            let filas = document.querySelectorAll('#tablaLibros tr');
            filas.forEach(row => {
                let titulo = row.cells[1].textContent.toLowerCase();
                if (titulo.includes(buscaTexto)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        window.onload = function () {
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();

            day = (day < 10) ? '0' + day : day;
            month = (month < 10) ? '0' + month : month;

            var todayFormatted = year + '-' + month + '-' + day;
            document.getElementById('fecha').value = todayFormatted;
        };
    </script>

    <div class="logout-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="logout" class="btn btn-danger">CERRAR SESIÓN</button>
        </form>
    </div>

</div>

<?php include '../templates/footer.php'; ?>