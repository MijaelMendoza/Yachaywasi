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

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <form action="registrar_ventas.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#informeVentasModal">
                        <a href="informeVentas.php" style="text-decoration: none;">
                            <img src="../../images/registro_venta.png" alt="Ventas" style="width: 100px;">
                            <div>INFORME VENTAS</div>
                        </a>
                    </button>
                </form>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <form action="registrar_inventario.php" method="post">
                    <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#informeInventarioModal">
                        <a href="informeInventario.php" style="text-decoration: none;">
                            <img src="../../images/registro_venta.png" alt="Inventario" style="width: 100px;">
                            <div>INFORME INVENTARIO</div>
                        </a>
                    </button>
                </form>
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