<?php
include '../templates/header.php';
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
                <form action="../Registros/registrar_venta.php" method="post">
                    <input type="hidden" name="sucursal"
                        value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#registroVentaModal">
                        <img src="../../images/registro_venta.png" alt="Venta" style="width: 100px;">
                        <div>REGISTRAR VENTA</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_pedido.php" method="post">
                    <input type="hidden" name="sucursal"
                        value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#registroPedidoModal">
                        <img src="../../images/registro_venta.png" alt="Pedido" style="width: 100px;">
                        <div>REGISTRAR PEDIDO</div>
                    </button>
                </form>
            </div>

            <div class="col">
                <form action="registrar_ingreso.php" method="post">
                    <input type="hidden" name="sucursal"
                        value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
                    <input type="hidden" name="user_id"
                        value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
                    <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#registroIngresoModal">
                        <img src="../../images/registro_venta.png" alt="Ingreso" style="width: 100px;">
                        <div>REGISTRAR INGRESO</div>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <?php include '../Registros/registrar_Venta.php'?>

    <div class="logout-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <button type="submit" name="logout" class="btn btn-danger">CERRAR SESIÓN</button>
        </form>
    </div>

</div>

<?php include '../templates/footer.php'; ?>