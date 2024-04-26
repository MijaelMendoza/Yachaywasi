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

    <!-- Ventana Modal de Registro de Libro -->
    <div class="modal fade" id="registroLibroModal" tabindex="-1" aria-labelledby="registroLibroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="registroLibroModalLabel">REGISTRAR LIBRO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Formulario de registro de libro -->
                <div class="modal-body">
                    <form id="formularioLibro" action="tu_script_para_guardar_libro.php" method="post">
                        <div class="mb-3">
                            <label for="nombreLibro" class="form-label">Nombre del Libro</label>
                            <input type="text" class="form-control" id="nombreLibro" name="nombre" required placeholder="Nombre del Libro">
                        </div>
                        <div class="mb-3">
                            <label for="generoLibro" class="form-label">Género</label>
                            <input type="text" class="form-control" id="generoLibro" name="genero" required placeholder="Género del Libro">
                        </div>
                        <div class="mb-3">
                            <label for="precioLibro" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precioLibro" name="precio" required placeholder="Precio del Libro">
                        </div>
                        <div class="mb-3">
                            <label for="tituloLibro" class="form-label">Título</label>
                            <input type="text" class="form-control" id="tituloLibro" name="titulo" required placeholder="Título del Libro">
                        </div>
                        <div class="mb-3">
                            <label for="editorialLibro" class="form-label">Editorial</label>
                            <input type="text" class="form-control" id="editorialLibro" name="editorial" required placeholder="Editorial del Libro">
                        </div>
                        <div class="mb-3">
                            <label for="anioPublicacionLibro" class="form-label">Año de Publicación</label>
                            <input type="number" class="form-control" id="anioPublicacionLibro" name="anioPublicacion" required placeholder="Año de Publicación">
                        </div>
                        <div class="mb-3">
                            <label for="stockLibro" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stockLibro" name="stock" required placeholder="Stock del Libro">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar Libro</button>
                        </div>
                    </form>
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