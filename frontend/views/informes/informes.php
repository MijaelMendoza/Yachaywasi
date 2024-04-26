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
                <form action="../Registros/registrar_ventas.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#informeVentasModal">
                        <img src="../../images/registro_venta.png" alt="Ventas" style="width: 100px;">
                        <div>INFORME VENTAS</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_inventario.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#informeInventarioModal">
                        <img src="../../images/registro_venta.png" alt="Inventario" style="width: 100px;">
                        <div>INFORME INVENTARIO</div>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Modal para el informe de ventas -->
    <div class="modal fade" id="informeVentasModal" tabindex="-1" aria-labelledby="informeVentasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="informeVentasModalLabel">INFORME DE VENTAS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va la tabla y/o contenido del informe de ventas -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>FECHA DE VENTA</th>
                                    <th>FORMA DE PAGO</th>
                                    <th>CANTIDAD DE VENTAS</th>
                                    <th>CANTIDAD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- [!] Las filas de la tabla se llenarán dinámicamente con la información de ventas -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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