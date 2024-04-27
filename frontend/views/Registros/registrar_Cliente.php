<?php
require_once '../../../backend/controllers/clientController.php';
$clienteController = new ClienteController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'registrar_cliente') {
    $nombre = $_POST['nombre'];
    $ci = $_POST['carnet'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha_registro = $_POST['fecha'];
    $segmento_cliente = $_POST['segmento'];
    $genero = $_POST['genero'];

    $validacion = validarDatosCliente($nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente, $genero);
    if ($validacion === true) {
        try {
            $clienteController->crearCliente([
                'nombre' => $nombre,
                'ci' => $ci,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'correo' => $correo,
                'fecha_registro' => $fecha_registro,
                'segmento_cliente' => $segmento_cliente,
                'genero' => $genero
            ]);
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                    document.getElementById('notificationMessage').innerHTML = '<strong>¡Éxito!</strong> El cliente ha sido registrado correctamente.';
                    modal.show();
                });
              </script>";
        } catch (e) {
            echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                    document.getElementById('notificationMessage').innerHTML = '<strong>Error:</strong> No se pudo registrar al cliente.';
                    modal.show();
                });
              </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                var modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                document.getElementById('notificationMessage').innerHTML = '<strong>Error:</strong> " . $validacion . "';
                modal.show();
            });
          </script>";
    }
}

function validarDatosCliente($nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente, $genero)
{
    if (empty($nombre) || empty($ci) || empty($direccion) || empty($telefono) || empty($correo) || empty($fecha_registro)) {
        return "Todos los campos son obligatorios.";
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return "El formato del correo electrónico no es válido.";
    }

    if (strlen($ci) < 5 || strlen($ci) > 10) {
        return "El CI debe tener entre 5 y 10 caracteres.";
    }
    $clienteController = new ClienteController();
    $clienteExistente = $clienteController->verificarExistenciaCliente($ci, $correo);
    if ($clienteExistente) {
        return "Un cliente con este CI o correo ya está registrado.";
    }
    return true;
}
?>
<!-- Modal de Notificación -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="notificationMessage">
                <!-- El mensaje se insertará dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Ventana Modal de Registro de Clientes -->
<div class="modal fade" id="registroClienteModal" tabindex="-1" aria-labelledby="registroClienteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroClienteModalLabel">REGISTRO DE CLIENTES</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="max-w-6xl mx-auto p-8 bg-white shadow-lg">
                    <form method="POST" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                            <div class="col-md-6">
                                <label for="carnet" class="form-label">Carnet de Identidad</label>
                                <input type="text" class="form-control" id="carnet" name="carnet"
                                    placeholder="Carnet de Identidad">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo">
                            </div>
                            <div class="col-md-6">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    placeholder="Dirección">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                    placeholder="Teléfono">
                            </div>
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">Fecha de Registro</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="2024-04-23">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="segmento" class="form-label">Segmento de Cliente</label>
                                <select class="form-select" id="segmento" name="segmento">
                                    <option value="Regular">Regular</option>
                                    <option value="Premium">Premium</option>
                                    <option value="Nuevo">Nuevo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-select" id="genero" name="genero">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="accion" value="registrar_cliente">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button id="cancelarRegistro" class="btn btn-danger me-md-2" type="button"
                                data-bs-dismiss="modal">CANCELAR</button>
                            <button id="registrarClienteBtn" class="btn btn-success" type="submit">REGISTRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>