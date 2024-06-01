<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
        }

        .sidenav {
            height: calc(100vh - 70px - 40px); /* Adjust height based on header and footer */
            width: 200px;
            position: fixed;
            top: 70px; /* Height of the header */
            left: 0;
            background-color: #111;
            padding-top: 20px;
        }

        .sidenav a {
            padding: 8px 8px 8px 16px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        .sidenav a:hover {
            background-color: #575757;
            color: white;
        }

        .main {
            margin-left: 200px; /* Same as the width of the sidenav */
            padding: 10px;
            height: calc(100vh - 70px - 40px); /* Adjust height based on header and footer */
            overflow: hidden;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>

    <div class="sidenav">
        <h2 style="color: white; text-align: center;">Panel de Control</h2>
        <a href="#" onclick="loadPage('general')">General</a>
        <a href="#" onclick="loadPage('cliente')">Cliente</a>
        <a href="#" onclick="loadPage('ventas')">Ventas</a>
        <a href="#" onclick="loadPage('inventario')">Inventario</a>
        <a href="#" onclick="loadPage('sucursal')">Sucursal</a>
        <a href="#" onclick="loadPage('funcionarios')">Funcionarios</a>
    </div>

    <div class="main">
        <iframe id="contentFrame" title="content"></iframe>
    </div>

    <script>
        function loadPage(page) {
            const frame = document.getElementById('contentFrame');
            switch (page) {
                case 'general':
                    frame.src = 'general.php';
                    break;
                case 'cliente':
                    frame.src = 'cliente.php';
                    break;
                case 'ventas':
                    frame.src = 'ventas.php';
                    break;
                case 'inventario':
                    frame.src = 'inventario.php';
                    break;
                case 'sucursal':
                    frame.src = 'sucursal.php';
                    break;
                case 'funcionarios':
                    frame.src = 'funcionarios.php';
                    break;
            }
        }

        // Load the default page
        loadPage('general');
    </script>

</body>

</html>
