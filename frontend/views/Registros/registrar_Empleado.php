<?php
require_once '../../../backend/controllers/empleadoController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'registrar_empleado') {
        $nombre = $_POST['nombre'];
        $ci = $_POST['ci'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_contratacion = $_POST['fecha_contratacion'];
        $cargo = $_POST['cargo'];
        $salario = $_POST['salario'];
        $sucursal = $_POST['Sucursal_cs'];

        $empleadoController = new EmpleadoController();

        $empleadoController->crearEmpleado([
            'nombre' => $nombre,
            'ci' => $ci,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'correo' => $correo,
            'fecha_contratacion' => $fecha_contratacion,
            'cargo' => $cargo,
            'salario' => $salario,
            'estado' => true, // Suponiendo que el empleado se registra activo
            'Sucursal_cs' => $sucursal
        ]);
    }
}
?>

<!-- Ventana Modal de Registro de Empleado -->
<div class="modal fade" id="registroEmpleadoModal" tabindex="-1" aria-labelledby="registroEmpleadoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroEmpleadoModalLabel">REGISTRAR EMPLEADO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de empleado -->
            <div class="modal-body">
                <form id="formularioEmpleado">
                    <div class="row mb-3">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <!-- Campo de Nombre del Empleado -->
                                <div class="col">
                                    <label for="nombreEmpleado" class="form-label">Nombre del Empleado</label>
                                    <input type="text" class="form-control" id="nombreEmpleado" placeholder="Nombre del Empleado">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Carnet de Identidad -->
                                <div class="col">
                                    <label for="carnetIdentidad" class="form-label">Carnet de Identidad</label>
                                    <input type="text" class="form-control" id="carnetIdentidad" placeholder="Carnet de Identidad">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Dirección -->
                                <div class="col">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" placeholder="Dirección">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Teléfono -->
                                <div class="col">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" placeholder="#######">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Correo -->
                                <div class="col">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="correo" placeholder="Correo">
                                </div>
                            </div>
                        </div>
                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <!-- Campo de Fecha de Registro -->
                                <div class="col">
                                    <label for="fechaRegistro" class="form-label">Fecha de Registro</label>
                                    <input type="date" class="form-control" id="fechaRegistro">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Cargo -->
                                <div class="col">
                                    <label for="cargo" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="cargo" placeholder="Cargo">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Salario -->
                                <div class="col">
                                    <label for="salario" class="form-label">Salario (Bs)</label>
                                    <input type="text" class="form-control" id="salario" placeholder="Salario">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Campo de Sucursal -->
                                <div class="col">
                                    <label for="sucursal" class="form-label">Sucursal</label>
                                    <select class="form-select" id="sucursal">
                                        <option selected>Seleccione...</option>
                                        <option value="1">Sucursal A</option>
                                        <option value="2">Sucursal B</option>
                                        <option value="3">Sucursal C</option>
                                        <!-- Agrega más opciones según sea necesario -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="registrarEmpleadoBtn" disabled>Registrar</button>
            </div>
        </div>
    </div>
</div>