<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/informe.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Ventas</title>
    <style>
        .container {
            width: 85%;
            height: 90%;
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 5%;
            text-align: center;
            position: relative;
        }

        table {
            border-collapse: collapse;
            text-align: left;
            margin: 1%;
            width: 90%;
            overflow-y: auto;
        }

        th,
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            width: 100%;
            padding: 2px;
            margin-top: 10px;
            box-sizing: border-box;
        }

        .line {
            position: absolute;
            left: 0;
            width: 100%;
            height: 2%;
            background-color: darkred;
            z-index: 1;
        }
    </style>
</head>

<body>
    <header>
        <h1 style="text-align:center;margin-top:2%;" class="mb-3">INFORME DE VENTAS</h1>
        <div class="line"></div>
    </header>
    <input
        style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23000\' width=\'24px\' height=\'24px\'%3E%3Cpath d=\'M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z\'/%3E%3Cpath d=\'M0 0h24v24H0z\' fill=\'none\'/%3E%3C/svg%3E'); background-size: 20px; background-repeat: no-repeat; background-position: 10px center; padding-left: 40px; margin-left: 77%; width: 15%; border-radius: 40px; margin-top: 3.5%;"
        type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar..">
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped" id="ventasTable">
                <thead>
                    <tr>
                        <th>Código de Venta</th>
                        <th>Fecha de Venta</th>
                        <th>Forma de Pago</th>
                        <th>Cantidad</th>
                        <th>Monto Total</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Sucursal</th>
                    </tr>
                </thead>
                <tbody id="ventasTableBody">
                    <?php
                    include '../../../backend/core/conexion.php';

                    // Function to retrieve data from the database
                    function obtenerDatos()
                    {
                        $conexion = Conectarse();
                        if (!$conexion) {
                            echo "<h1>No se puede conectar a la base de datos.</h1>";
                            exit();
                        }
                        $consulta = "SELECT DISTINCT
                        v.cv,
                        v.fecha_venta,
                        v.forma_pago,
                        v.cantidad,
                        v.monto,
                        c.nombre AS cliente,
                        e.nombre AS empleado,
                        s.nombre AS sucursal
                    FROM
                        Ventas v
                    JOIN
                        detalle_venta cdv ON v.cv = cdv.Ventas_cv
                    JOIN
                        Cliente c ON v.Cliente_cu = c.cu
                    JOIN
                        Empleado e ON v.Empleado_ca = e.ca
                    JOIN
                        Sucursal s ON v.Sucursal_cs = s.cs
                    ORDER BY
                        v.cantidad DESC;
                    ";
                        // Execute the query
                        $resultado = $conexion->query($consulta);
                        if (!$resultado) {
                            echo "Error en la consulta.";
                            exit();
                        }
                        // Fetch data from the result set as associative array
                        $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
                        // Close connection
                        $conexion = null;
                        return $datos;
                    }
                    // Fetch data
                    $datos = obtenerDatos();
                    // Output data as table rows
                    foreach ($datos as $dato) {
                        echo "<tr>";
                        echo "<td>" . $dato['cv'] . "</td>";
                        echo "<td>" . $dato['fecha_venta'] . "</td>";
                        echo "<td>" . $dato['forma_pago'] . "</td>";
                        echo "<td>" . $dato['cantidad'] . "</td>";
                        echo "<td>" . $dato['monto'] . "</td>";
                        echo "<td>" . $dato['cliente'] . "</td>";
                        echo "<td>" . $dato['empleado'] . "</td>";
                        echo "<td>" . $dato['sucursal'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>

    </footer>
    <script>
        document.getElementById('regresarBtn').addEventListener('click', function () {
            window.location.href = 'informes.php';
        });
    </script>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("ventasTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[5];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>