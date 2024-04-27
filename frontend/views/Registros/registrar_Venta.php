<?php
require_once '../../../backend/controllers/librosController.php';
require_once '../../../backend/controllers/clientController.php';
require_once '../../../backend/controllers/ventaController.php';
$ventasController = new VentasController();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'registrar_venta') {
        $fecha_venta = $_POST['fecha_venta'];
        $forma_pago = $_POST['forma_pago'];
        $cliente_cu = $_POST['cliente_cu'];
        $empleado_ca = $_SESSION['user_id'];
        $sucursal_cs = $_SESSION['user_sucursal'];
        $detalles = $_POST['detalles'] ?? [];
        $cantidad = $_POST['cantidad'];
        $monto = $_POST['monto'];

        $ventasController->agregarVentaConDetalles($fecha_venta, $forma_pago, $monto, $cantidad, $cliente_cu, $empleado_ca, $sucursal_cs, $detalles);
    }
}

$clienteController = new ClienteController();
$clientes = json_decode($clienteController->listarClientes(), true);

$libroController = new LibroController();
$libros = json_decode($libroController->listarLibros(), true);
?>
<style>
    #miModalAncho {
        max-width: 90%;
    }

    .modal .table-responsive {
        overflow-x: hidden;
        overflow-y: auto;
    }

    #tablaClientes .cliente-row {
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s, color 0.3s;
    }

    #tablaClientes .cliente-row:hover {
        background-color: #e0e0e0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        color: #333;
    }

    p {
        font-weight: bold;
    }
</style>

<!-- Ventana Modal de Registro de Venta -->
<div class="modal fade" id="registroVentaModal" tabindex="-1" aria-labelledby="registroVentaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" id="miModalAncho">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroVentaModalLabel">REGISTRAR VENTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de ventas -->
            <div class="modal-body">
                <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
                    <div class="modal-body" style="max-height: 350px;">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Lista de libros disponibles para agregar a la venta -->
                                <p>Libros
                                <p>
                                    <input type="text" id="buscarLibro" class="form-control mb-3"
                                        placeholder="Buscar libro por título...">
                                <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
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
                                                        <input type="number" class="form-control cantidad" min="0" value="1"
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
                                </div>
                            </div>
                            <div class="col-md-6">
                                <!-- Lista de clientes disponibles para seleccionar en la venta -->
                                <p>Clientes
                                <p>
                                    <input type="text" id="buscarCliente" class="form-control mb-3"
                                        placeholder="Buscar cliente por nombre...">
                                <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">CU</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">CI</th>
                                                <th scope="col">Teléfono</th>
                                                <th scope="col">Correo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaClientes">
                                            <?php foreach ($clientes as $cliente): ?>
                                                <tr class="cliente-row"
                                                    data-cliente-id="<?php echo htmlspecialchars($cliente['cu']); ?>">
                                                    <td><?php echo htmlspecialchars($cliente['cu']); ?></td>
                                                    <td><?php echo htmlspecialchars($cliente['nombre']); ?></td>
                                                    <td><?php echo htmlspecialchars($cliente['ci']); ?></td>
                                                    <td><?php echo htmlspecialchars($cliente['telefono']); ?></td>
                                                    <td><?php echo htmlspecialchars($cliente['correo']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                </select>
                            </div>
                            <!-- Campo de Nombre del Cliente -->
                            <div class="col">
                                <label for="nombreCliente" class="form-label">Nombre Cliente</label>
                                <input type="text" class="form-control" id="nombreCliente"
                                    placeholder="Nombre del cliente" readonly>
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
                <input type="hidden" name="accion" value="registrar_venta">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="registroVenta">Registrar</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="clienteID" name="cliente_cu">
<input type="hidden" id="libroID" name="libro_cl">

<script>
    document.querySelectorAll('.cliente-row').forEach(row => {
        row.addEventListener('click', function () {
            const clienteId = this.getAttribute('data-cliente-id');
            const nombreCliente = this.cells[1].textContent;
            document.getElementById('nombreCliente').value = nombreCliente;
            document.getElementById('clienteID').value = clienteId;
        });
    });

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
                item.dataset.libroId = libroId;

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

    document.getElementById('buscarCliente').addEventListener('input', function () {
        let buscaTexto = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaClientes tr');
        filas.forEach(row => {
            let nombre = row.cells[1].textContent.toLowerCase();
            if (nombre.includes(buscaTexto)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('.btn-elegir').forEach(button => {
        button.addEventListener('click', function () {
            const clienteId = this.getAttribute('data-cliente-id');
            const nombreCliente = this.closest('tr').cells[1].textContent;
            document.getElementById('nombreCliente').value = nombreCliente;
            document.getElementById('clienteID').value = clienteId;
        });
    });

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

    function resetearFormulario() {
        document.getElementById('formaPago').value = 'Seleccione...';
        document.getElementById('nombreCliente').value = '';
        document.getElementById('monto').value = '';

        const listaLibros = document.getElementById('librosAgregados');
        listaLibros.innerHTML = '';
    }

    document.getElementById('registroVenta').addEventListener('click', function () {
        if (validarFormulario()) {
            let fecha = document.getElementById('fecha').value;
            let formaPago = document.getElementById('formaPago').value;
            let clienteId = document.getElementById('clienteID').value;
            let librosAgregados = document.getElementById('librosAgregados').children;
            let montoTotal = document.getElementById('monto').value;

            let cantidadTotal = 0;
            let formData = new FormData();
            formData.append('fecha_venta', fecha);
            formData.append('forma_pago', formaPago);
            formData.append('cliente_cu', clienteId);
            formData.append('monto', montoTotal);

            Array.from(librosAgregados).forEach((libro, index) => {
                let libroCantidad = parseInt(libro.dataset.cantidad, 10);
                formData.append(`detalles[${index}][libro_id]`, libro.dataset.libroId);
                formData.append(`detalles[${index}][cantidad]`, libroCantidad);
                formData.append(`detalles[${index}][precio_unitario]`, libro.dataset.precio);
                cantidadTotal += libroCantidad;
            });
            formData.append('cantidad', cantidadTotal);

            fetch('../Registros/registrar_Venta.php', {
                method: 'POST',
                body: formData
            }).then(response => response.text())
                .then(data => {
                    alert("Registro Exitoso");
                    resetearFormulario();

                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

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

    function validarFormulario() {
        let nombreCliente = document.getElementById('nombreCliente').value;
        let fecha = document.getElementById('fecha').value;
        let formaPago = document.getElementById('formaPago').value;
        let librosAgregados = document.getElementById('librosAgregados').children.length;
        let montoTotal = document.getElementById('monto').value;

        if (!nombreCliente) {
            alert('Por favor, seleccione un cliente.');
            return false;
        }
        if (!fecha) {
            alert('Por favor, introduzca la fecha.');
            return false;
        }
        if (formaPago === "Seleccione...") {
            alert('Por favor, seleccione una forma de pago.');
            return false;
        }
        if (librosAgregados === 0) {
            alert('Por favor, agregue al menos un libro a la venta.');
            return false;
        }
        if (!montoTotal || parseFloat(montoTotal) <= 0) {
            alert('El monto total no puede estar vacío o ser cero.');
            return false;
        }

        return true;
    }

</script>