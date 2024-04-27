<?php include '../templates/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Libros</title>
<style>
    .container {
        width: 800px;
        height: 600px;
        overflow: auto;
        border: 1px solid #ccc;
        padding: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-top: 10px;
        box-sizing: border-box;
    }
</style>
</head>
<body>

<div class="container">
    <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search for names..">
    <table id="librosTable">
        <thead>
            <tr>
                <th>CL</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Precio</th>
                <th>Título</th>
                <th>Proveedor</th>
                <th>Fecha de Recepción</th>
                <th>Precio Unitario</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody id="librosTableBody">
            <?php
            // Function to connect to the database
            function Conectarse(){
                $host = 'localhost';
                $usuario = 'postgres';
                $contrasena = 'admin';
                $nombre_bd = 'yachaywasi';
                try {
                    $conn = @new PDO("pgsql:host=$host;dbname=$nombre_bd;user=$usuario;password=$contrasena");
                } catch (Exception $e) {
                    echo "sdsa";
                    echo $e->getMessage();
                }
                return $conn;
            }

            // Function to retrieve data from the database
            function obtenerDatos()
            {
                $conexion = Conectarse();

                if (!$conexion) {
                    echo "<h1>No se puede conectar a la base de datos.</h1>";
                    exit();
                }

                $consulta = "SELECT l.cl, l.nombre AS nombre_libro, l.genero, l.precio, l.titulo, p.nombre AS nombre_proveedor, pp.fecha_repeccion, dv.precio_unitario, l.stock 
                             FROM Libros l
                             INNER JOIN pedidos_proveedores_libros ppl ON l.cl = ppl.Libros_cl
                             INNER JOIN Pedidos_proveedores pp ON ppl.Pedidos_proveedores_cpep = pp.cpep
                             INNER JOIN Proveedores p ON pp.Proveedores_cpr = p.cpr
                             INNER JOIN detalle_venta dv ON l.cl = dv.Libros_cl";
                
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
                echo "<td>" . $dato['nombre_libro'] . "</td>";
                echo "<td>" . $dato['genero'] . "</td>";
                echo "<td>" . $dato['precio'] . "</td>";
                echo "<td>" . $dato['titulo'] . "</td>";
                echo "<td>" . $dato['nombre_proveedor'] . "</td>";
                echo "<td>" . $dato['fecha_repeccion'] . "</td>";
                echo "<td>" . $dato['precio_unitario'] . "</td>";
                echo "<td>" . $dato['stock'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

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
