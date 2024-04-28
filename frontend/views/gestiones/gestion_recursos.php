<?php
session_start();
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
                <form action="registrar_Empleado.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#registroEmpleadoModal">
                        <img src="../../images/registro_venta.png" alt="Empleado" style="width: 100px;">
                        <div>REGISTRAR EMPLEADO</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_proveedor.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#registroProveedorModal">
                        <img src="../../images/registro_venta.png" alt="Proveedor" style="width: 100px;">
                        <div>REGISTRAR PROVEEDOR</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_libro.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#registroLibroModal">
                        <img src="../../images/registro_venta.png" alt="Libro" style="width: 100px;">
                        <div>REGISTRAR LIBRO</div>
                    </button>
                </form>
            </div>


            <div class="col">
                <form action="registrar_pedido.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#registroEmpleadoModal">
                        <img src="../../images/registro_venta.png" alt="Pedido" style="width: 100px;">
                        <div>REGISTRAR PEDIDO</div>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../Registros/registrar_Empleado.php' ?>
  
    <!-- Ventana Modal de Registro de Proveedor -->
    <div class="modal fade" id="registroProveedorModal" tabindex="-1" aria-labelledby="registroProveedorModalLabel"
        aria-hidden="true">
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
                                        <input type="text" class="form-control" id="nombreProveedor"
                                            placeholder="Nombre del Proveedor">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Campo de Teléfono -->
                                    <div class="col">
                                        <label for="telefonoProveedor" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefonoProveedor"
                                            placeholder="#######">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Campo de Correo -->
                                    <div class="col">
                                        <label for="correoProveedor" class="form-label">Correo</label>
                                        <input type="email" class="form-control" id="correoProveedor"
                                            placeholder="Correo">
                                    </div>
                                </div>
                            </div>
                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <!-- Campo de Fecha de Registro -->
                                    <div class="col">
                                        <label for="fechaRegistroProveedor" class="form-label">Fecha de Registro</label>
                                        <!-- En el formulario de registro de proveedor -->
                                        <input type="date" class="form-control" id="fechaRegistroProveedor"
                                            value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <!-- Campo de Contacto -->
                                    <div class="col">
                                        <label for="contactoProveedor" class="form-label">Contacto </label>
                                        <input type="text" class="form-control" id="contactoProveedor"
                                            placeholder="Contacto">
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


    <div class="logout-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="logout" class="btn btn-danger">CERRAR SESIÓN</button>
        </form>
    </div>

</div>

<?php include '../templates/footer.php'; ?>