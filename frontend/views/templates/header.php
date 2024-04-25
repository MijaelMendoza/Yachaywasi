<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yachaywasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #ff5722;
            padding: 0.5rem 1rem;
        }
        .navbar-custom .navbar-brand {
            color: #ffffff;
            font-weight: bold;
        }
        .navbar-custom .nav-link {
            color: #ffffff;
            background-color: #ff5722;
            margin: 0.5rem;
            border-radius: 0;
        }
        .navbar-custom .nav-link:hover, .navbar-custom .nav-link:focus {
            color: #ff5722;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../../images/logo.jpg" alt="Logo" style="height:40px;">
                    LIBRERÍA YACHAYWASI
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="../homePage/homeAdmin.php">Home</a>
                        <a class="nav-link" href="../gestiones/gestion_inventario.php">Gestión Inventario</a>
                        <a class="nav-link" href="../gestiones/gestion_recursos.php">Gestión de Recursos</a>
                        <a class="nav-link" href="../informes/informes.php">Informes</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
