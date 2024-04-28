<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/informe.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Libros</title>
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
            /* Add scrollbar only for vertical overflow */
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
            /* Ensure the line is above other content */
        }
    </style>
</head>

<body>
    <header>
        <h1 style="text-align:center;margin-top:2%;" class="mb-3">INFORME DE INVENTARIO</h1>
        <div class="line"></div>
    </header>

    <input
        style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'%23000\' width=\'24px\' height=\'24px\'%3E%3Cpath d=\'M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z\'/%3E%3Cpath d=\'M0 0h24v24H0z\' fill=\'none\'/%3E%3C/svg%3E'); background-size: 20px; background-repeat: no-repeat; background-position: 10px center; padding-left: 40px; margin-left: 77%; width: 15%; border-radius: 40px; margin-top: 3.5%;"
        type="text" id="searchInput" onkeyup="searchTable()" placeholder="Buscar..">

    <div class="container mt-5">

        <div class="table-responsive">
            <table class="table table-striped" id="librosTable">

                <thead>
                    <tr>
                        <th>CL</th>
                        <th>Título</th>
                        <th>Género</th>
                        <th>Stock</th>
                        <th>Costo</th>
                        <th>Precio Unitario</th>
                        <th>Proveedor</th>
                        <th>Fecha de Recepción</th>
                    </tr>
                </thead>
                <tbody id="librosTableBody">
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

                        $consulta = "SELECT l.cl, l.genero, l.precio, l.titulo, pp.fecha_repeccion, dv.precio_unitario, l.stock 
                        FROM Libros l
                        INNER JOIN pedidos_proveedores_libros ppl ON l.cl = ppl.Libros_cl
                        INNER JOIN Pedidos_proveedores pp ON ppl.Pedidos_proveedores_cpep = pp.cpep
                        INNER JOIN Proveedores p ON pp.Proveedores_cpr = p.cpr
                        INNER JOIN detalle_venta dv ON l.cl = dv.Libros_cl
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
                        echo "<td>" . $dato['cl'] . "</td>";
                        echo "<td>" . $dato['titulo'] . "</td>";
                        echo "<td>" . $dato['genero'] . "</td>";
                        echo "<td>" . $dato['stock'] . "</td>";
                        echo "<td>" . $dato['precio'] . "</td>";
                        echo "<td>" . $dato['precio_unitario'] . "</td>";
                        echo "<td>" . $dato['nombre_proveedor'] . "</td>";
                        echo "<td>" . $dato['fecha_repeccion'] . "</td>";


                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>
    <footer>
        <button id="regresarBtn" class="btn btn-danger"
            style="border-radius: 10px; margin-left:78%;margin-top:3%;width:15%;margin-bottom:3%;background-color:orange;color:black;border-color:black;">CERRAR
            SESION</button>
    </footer>
    <script>


        // Código adicional para redirigir al hacer clic en el botón "Dibujar Grafo"
        document.getElementById('regresarBtn').addEventListener('click', function () {
            window.location.href = 'informes.php';
        });

    </script>





    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("librosTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Index 1 for 'Nombre' column
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