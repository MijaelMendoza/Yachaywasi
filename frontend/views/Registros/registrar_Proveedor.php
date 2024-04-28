<?php
require_once '../../../backend/controllers/proveedorController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'registrar_proveedor') {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_registro = $_POST['fecha_registro'];
        $contacto = $_POST['contacto'];

        $proveedorController = new ProveedoresController();

        $proveedorController->agregarProveedor($nombre, $contacto, $correo, $telefono, true); // true representa el estado del proveedor (activo)
    }
}
?>

<!-- Ventana Modal de Registro de Proveedor -->
<div class="modal fade" id="registroProveedorModal" tabindex="-1" aria-labelledby="registroProveedorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroProveedorModalLabel">REGISTRAR PROVEEDOR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de proveedor -->
            <div class="modal-body">
                <form id="formularioProveedor">
                    <div class="row mb-3">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <!-- Campo de Nombre del Proveedor -->
                                <div class="col">
                                    <label for="nombreProveedor" class="form-label">Nombre del Proveedor</label>
                                    <input type="text" class="form-control" id="nombreProveedor" placeholder="Nombre del Proveedor">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Teléfono -->
                                <div class="col">
                                    <label for="telefonoProveedor" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefonoProveedor" placeholder="#######">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Correo -->
                                <div class="col">
                                    <label for="correoProveedor" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="correoProveedor" placeholder="Correo">
                                </div>
                            </div>
                        </div>
                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <!-- Campo de Fecha de Registro -->
                                <div class="col">
                                    <label for="fechaRegistroProveedor" class="form-label">Fecha de Registro</label>
                                    <input type="date" class="form-control" id="fechaRegistroProveedor">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Contacto -->
                                <div class="col">
                                    <label for="contactoProveedor" class="form-label">Contacto </label>
                                    <input type="text" class="form-control" id="contactoProveedor" placeholder="Contacto">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="registrarProveedorBtn" disabled>Registrar</button>
            </div>
        </div>
    </div>
</div>