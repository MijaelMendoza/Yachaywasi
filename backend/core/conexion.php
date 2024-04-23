<?php
// Function to connect to the database
function Conectarse()
{
    $conn_string = "host=localhost port=5432 dbname=mypicture user=postgres password=admin";
    $link = pg_connect($conn_string);

    if (!$link) {
        return false;
    }
    return $link;
}

// Functions related to the Cliente table
function altaCliente($cu, $nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede dar de alta. Error al conectar.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Cliente (cu, nombre, ci, direccion, telefono, correo, fecha_registro, segmento_cliente) VALUES ('$cu', '$nombre', '$ci', '$direccion', '$telefono', '$correo', '$fecha_registro', '$segmento_cliente')";

    echo $consulta;

    $resultado = pg_query($conexion, $consulta);

    pg_close($conexion);
}

function bajaCliente($cu)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede dar de baja. Error al conectar.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Cliente WHERE cu = $cu";

    echo $consulta . "<BR>";

    $resultado = pg_query($conexion, $consulta);

    pg_close($conexion);
}

function modificacionCliente($cu, $nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede dar de alta. Error al conectar.</h1>";
        exit();
    }

    $consulta = "UPDATE Cliente SET nombre='$nombre', ci='$ci', direccion='$direccion', telefono='$telefono', correo='$correo', fecha_registro='$fecha_registro', segmento_cliente='$segmento_cliente' WHERE cu='$cu'";

    echo $consulta;

    $resultado = pg_query($conexion, $consulta);

    pg_close($conexion);
}

function obtenerClientes()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Cliente";

    $resultado = pg_query($conexion, $consulta);

    // Check if query was successful
    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $clientes = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $clientes;
}

// Usage example: Fetch all clients
$clientes = obtenerClientes();

// Display the retrieved data
foreach ($clientes as $cliente) {
    echo "CU: " . $cliente['cu'] . ", Nombre: " . $cliente['nombre'] . ", CI: " . $cliente['ci'] . "<br>";
}








// Functions related to the Editorial table
function altaEditorial($ce, $nombre, $contacto, $direccion, $telefono, $correo)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede dar de alta. Error al conectar.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Editorial (ce, nombre, contacto, direccion, telefono, correo) VALUES ('$ce', '$nombre', '$contacto', '$direccion', '$telefono', '$correo')";

    echo $consulta;

    $resultado = pg_query($conexion, $consulta);

    pg_close($conexion);
}

function bajaEditorial($ce)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede dar de baja. Error al conectar.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Editorial WHERE ce = $ce";

    echo $consulta . "<BR>";

    $resultado = pg_query($conexion, $consulta);

    pg_close($conexion);
}

function modificacionEditorial($ce, $nombre, $contacto, $direccion, $telefono, $correo)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede dar de alta. Error al conectar.</h1>";
        exit();
    }

    $consulta = "UPDATE Editorial SET nombre='$nombre', contacto='$contacto', direccion='$direccion', telefono='$telefono', correo='$correo' WHERE ce='$ce'";

    echo $consulta;

    $resultado = pg_query($conexion, $consulta);

    pg_close($conexion);
}

function obtenerEditoriales()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Editorial";

    $resultado = pg_query($conexion, $consulta);

    // Check if query was successful
    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $editoriales = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $editoriales;
}

// Usage example: Fetch all editorials
$editoriales = obtenerEditoriales();

// Display the retrieved data
foreach ($editoriales as $editorial) {
    echo "CE: " . $editorial['ce'] . ", Nombre: " . $editorial['nombre'] . ", Contacto: " . $editorial['contacto'] . "<br>";
}
















?>
