<?php
require_once '../../../backend/controllers/librosController.php';
require_once '../../../backend/controllers/proveedorController.php';
require_once '../../../backend/controllers/pedidoProveedorController.php';
require_once '../../../backend/core/Conexion.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$proveedoresController = new ProveedoresController();
$proveedores = json_decode($proveedoresController->mostrarProveedores(), true);

$libroController = new LibroController();
$libros = json_decode($libroController->listarLibros(), true);

$pedidoProveedorController = new PedidosProveedoresController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['accion'] == 'registrar_pedido') {
        $formaPago = $_POST['forma_pago'];
        $montoTotal = $_POST['monto'];
        $proveedorID = $_POST['proveedores_cpr'];
        $detalles = $_POST['detalles'] ?? [];
        $fechaPedido = !empty($_POST['fecha_pedido']) ? new DateTime($_POST['fecha_pedido']) : new DateTime();

        $fechaRecepcion = clone $fechaPedido;
        $fechaRecepcion->add(new DateInterval('P5D'));
        
        $fechaPedidoFormatted = $fechaPedido->format('Y-m-d');
        $fechaRecepcionFormatted = $fechaRecepcion->format('Y-m-d');
        
        $pedidoProveedorController->agregarPedidoConDetalles(
            $formaPago,
            array_sum(array_column($detalles, 'cantidad')),
            $montoTotal,
            $fechaPedidoFormatted,
            $fechaRecepcionFormatted,
            $proveedorID,
            $detalles
        );
        exit;
    }
}
?>
<style>
    #miModalAncho {
        max-width: 90%;
    }

    .modal .table-responsive {
        overflow-x: hidden;
        overflow-y: auto;
    }

    #tablaProveedores .proveedor-row {
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s, color 0.3s;
    }

    #tablaProveedores .proveedor-row:hover {
        background-color: #e0e0e0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        color: #333;
    }

    p {
        font-weight: bold;
    }
</style>

<!-- Pedidona Modal de Registro de Pedido -->
<div class="modal fade" id="registroPedidoModal" tabindex="-1" aria-labelledby="registroPedidoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" id="miModalAncho">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroPedidoModalLabel">REGISTRAR PEDIDO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de pedidos -->
            <div class="modal-body">
                <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
                    <div class="modal-body" style="max-height: 350px;">
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Lista de libros disponibles para agregar a la pedido -->
                                <p>Libros
                                <p>
                                    <input type="text" id="buscarLibro" class="form-control mb-3"
                                        placeholder="Buscar libro por título...">
                                <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
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
                                <!-- Lista de proveedores disponibles para seleccionar en la pedido -->
                                <p>Proveedores
                                <p>
                                    <input type="text" id="buscarProveedor" class="form-control mb-3"
                                        placeholder="Buscar proveedor por nombre...">
                                <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">CPR</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Contacto</th>
                                                <th scope="col">Correo</th>
                                                <th scope="col">Teléfono</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaProveedores">
                                            <?php foreach ($proveedores as $proveedor): ?>
                                                <tr class="proveedor-row"
                                                    data-proveedor-id="<?php echo htmlspecialchars($proveedor['cpr']); ?>">
                                                    <td><?php echo htmlspecialchars($proveedor['cpr']); ?></td>
                                                    <td><?php echo htmlspecialchars($proveedor['nombre']); ?></td>
                                                    <td><?php echo htmlspecialchars($proveedor['contacto']); ?></td>
                                                    <td><?php echo htmlspecialchars($proveedor['correo']); ?></td>
                                                    <td><?php echo htmlspecialchars($proveedor['telefono']); ?></td>
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
                                <input type="date" class="form-control" id="fechaV" name="fechaV">
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
                            <!-- Campo de Nombre del Proveedor -->
                            <div class="col">
                                <label for="nombreProveedorPed" class="form-label">Nombre Proveedor</label>
                                <input type="text" class="form-control" id="nombreProveedorPed"
                                    placeholder="Nombre del proveedor" readonly>
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
                <input type="hidden" name="accion" value="registrar_pedido">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="registroPedido">Registrar</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="accion" value="registrar_pedido">
<input type="hidden" id="proveedorID" name="proveedores_cpr">
<input type="hidden" id="libroID" name="libro_cl">

<script>
    document.querySelectorAll('.proveedor-row').forEach(row => {
        row.addEventListener('click', function () {
            const proveedorid = this.getAttribute('data-proveedor-id');
            const nombreProveedorPed = this.cells[1].textContent;
            document.getElementById('nombreProveedorPed').value = nombreProveedorPed;
            document.getElementById('proveedorID').value = proveedorid;
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

    document.getElementById('buscarProveedor').addEventListener('input', function () {
        let buscaTexto = this.value.toLowerCase();
        let filas = document.querySelectorAll('#tablaProveedores tr');
        filas.forEach(row => {
            let nombre = row.cells[1].textContent.toLowerCase();
            if (nombre.includes(buscaTexto)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
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
        document.getElementById('nombreProveedorPed').value = '';
        document.getElementById('monto').value = '';

        const listaLibros = document.getElementById('librosAgregados');
        listaLibros.innerHTML = '';
    }

    document.getElementById('registroPedido').addEventListener('click', function () {
        if (validarFormulario()) {
            let fecha = document.getElementById('fechaV').value;
            let formaPago = document.getElementById('formaPago').value;
            let proveedorid = document.getElementById('proveedorID').value;
            let librosAgregados = document.getElementById('librosAgregados').children;
            let montoTotal = document.getElementById('monto').value;

            let cantidadTotal = 0;
            let formData = new FormData();
            formData.append('accion', 'registrar_pedido');
            formData.append('fecha_pedido', fecha);
            formData.append('forma_pago', formaPago);
            formData.append('proveedores_cpr', proveedorid);
            formData.append('monto', montoTotal);

            Array.from(librosAgregados).forEach((libro, index) => {
                let libroCantidad = parseInt(libro.dataset.cantidad, 10);
                formData.append(`detalles[${index}][libro_id]`, libro.dataset.libroId);
                formData.append(`detalles[${index}][cantidad]`, libroCantidad);
                formData.append(`detalles[${index}][precio_unitario]`, libro.dataset.precio);
                cantidadTotal += libroCantidad;
            });
            formData.append('cantidad', cantidadTotal);

            fetch('../Registros/registrar_Pedido.php', {
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

    document.addEventListener('DOMContentLoaded', function () {
        var today = new Date();
        var day = today.getDate();
        var month = today.getMonth() + 1;
        var year = today.getFullYear();

        day = (day < 10) ? '0' + day : day;
        month = (month < 10) ? '0' + month : month;

        var todayFormatted = year + '-' + month + '-' + day;
        document.getElementById('fechaV').value = todayFormatted;
    });


    function validarFormulario() {
        let nombreProveedorPed = document.getElementById('nombreProveedorPed').value;
        let fecha = document.getElementById('fechaV').value;
        let formaPago = document.getElementById('formaPago').value;
        let librosAgregados = document.getElementById('librosAgregados').children.length;
        let montoTotal = document.getElementById('monto').value;

        if (!nombreProveedorPed) {
            alert('Por favor, seleccione un proveedor.');
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
            alert('Por favor, agregue al menos un libro a la pedido.');
            return false;
        }
        if (!montoTotal || parseFloat(montoTotal) <= 0) {
            alert('El monto total no puede estar vacío o ser cero.');
            return false;
        }

        return true;
    }

</script>