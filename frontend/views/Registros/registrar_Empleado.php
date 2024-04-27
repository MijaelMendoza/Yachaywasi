<?php
include '../../../backend/core/conexion.php';
$sucursales = obtenerSucursales();
function validarDatosEmpleado($nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $Sucursal_cs)
{
    if (empty($nombre) || empty($ci) || empty($password) || empty($direccion) || empty($telefono) || empty($correo) || empty($cargo) || empty($fecha_contratacion) || empty($salario)) {
        return "Todos los campos son obligatorios.";
    }
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return "El formato del correo electrónico no es válido.";
    }
    if (!is_numeric($salario) || $salario <= 0) {
        return "El salario debe ser un número positivo.";
    }
    if (strlen($ci) < 5 || strlen($ci) > 10) {
        return "La cédula de identidad debe tener entre 5 y 10 caracteres.";
    }
    if (verificarEmpleadoExistente($ci, $correo)) {
        return "Un empleado con ese CI o correo electrónico ya está registrado.";
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'register_employee') {
        $nombre = $_POST['nombre'];
        $ci = $_POST['ci'];
        $password = $_POST['ci'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $cargo = $_POST['cargo'];
        $fecha_contratacion = $_POST['fecha_contratacion'];
        $salario = (int) $_POST['salario'];
        $Sucursal_cs = (int) $_POST['Sucursal_cs'];

        $validacion = validarDatosEmpleado($nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $Sucursal_cs);
        if ($validacion === true) {
            if (insertarEmpleado($nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $Sucursal_cs)) {
                echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                    document.getElementById('notificationMessage').innerHTML = '<strong>¡Éxito!</strong> El empleado ha sido registrado correctamente.';
                    modal.show();
                });
              </script>";
            } else {
                echo "<script type='text/javascript'>
                document.addEventListener('DOMContentLoaded', function() {
                    var modal = new bootstrap.Modal(document.getElementById('notificationModal'));
                    document.getElementById('notificationMessage').innerHTML = '<strong>Error:</strong> No se pudo registrar al empleado.';
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
}
?>

<!-- Ventana Modal de Registro de Empleado -->
<div class="modal fade" id="registroEmpleadoModal" tabindex="-1" aria-labelledby="registroEmpleadoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroEmpleadoModalLabel">REGISTRAR EMPLEADO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de empleado -->
            <div class="modal-body">
                <form id="formularioEmpleado" method="post" action="gestion_recursos.php">
                    <div class="row mb-3">
                        <!-- Columna Izquierda -->
                        <div class="col-md-6">
                            <!-- Campo de Nombre del Empleado -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="nombreEmpleado" class="form-label">Nombre del Empleado</label>
                                    <input type="text" class="form-control" id="nombreEmpleado" name="nombre"
                                        placeholder="Nombre del Empleado" required>
                                </div>
                            </div>
                            <!-- Campo de Carnet de Identidad -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="carnetIdentidad" class="form-label">Carnet de Identidad</label>
                                    <input type="text" class="form-control" id="carnetIdentidad" name="ci"
                                        placeholder="Carnet de Identidad" required>
                                </div>
                            </div>
                            <!-- Campo de Dirección -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        placeholder="Dirección" required>
                                </div>
                            </div>
                            <!-- Campo de Teléfono -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="telefono" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="telefono" name="telefono"
                                        placeholder="#######" required>
                                </div>
                            </div>
                            <!-- Campo de Correo -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" id="correo" name="correo"
                                        placeholder="Correo" required>
                                </div>
                            </div>
                        </div>
                        <!-- Columna Derecha -->
                        <div class="col-md-6">
                            <!-- Campo de Fecha de Registro -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="fechaRegistro" class="form-label">Fecha de Registro</label>
                                    <input type="date" class="form-control" id="fechaRegistro" name="fecha_contratacion"
                                        value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>
                            <!-- Campo de Cargo -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="cargo" class="form-label">Cargo</label>
                                    <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo"
                                        required>
                                </div>
                            </div>
                            <!-- Campo de Salario -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="salario" class="form-label">Salario (Bs)</label>
                                    <input type="text" class="form-control" id="salario" name="salario"
                                        placeholder="Salario" required>
                                </div>
                            </div>
                            <!-- Campo de Sucursal -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="sucursalProveedor" class="form-label">Sucursal</label>
                                    <select class="form-select" id="sucursalProveedor" name="Sucursal_cs" required>
                                        <option selected>Seleccione...</option>
                                        <?php foreach ($sucursales as $sucursal): ?>
                                            <option value="<?php echo htmlspecialchars($sucursal['cs']); ?>">
                                                <?php echo htmlspecialchars($sucursal['nombre']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Botones del formulario -->
                        <div class="modal-footer">
                            <input type="hidden" name="action" value="register_employee">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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