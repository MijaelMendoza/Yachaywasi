<<<<<<< Updated upstream
=======
<?php
// Function to connect to the database
function Conectarse()
{
    $conn_string = "host=localhost port=5432 dbname=Yachaywasi user=postgres password=admin";
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




// Function to retrieve data from the Proveedores table
function obtenerProveedores()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Proveedores";

    $resultado = pg_query($conexion, $consulta);

    // Check if query was successful
    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $proveedores = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $proveedores;
}

// Usage example: Fetch all providers
$proveedores = obtenerProveedores();

// Display the retrieved data
foreach ($proveedores as $proveedor) {
    echo "CPR: " . $proveedor['cpr'] . ", Nombre: " . $proveedor['nombre'] . ", Contacto: " . $proveedor['contacto'] . "<br>";
}



// Function to insert data into the Proveedores table
function insertarProveedor($cpr, $nombre, $contacto, $correo, $telefono)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Proveedores (cpr, nombre, contacto, correo, telefono) VALUES ('$cpr', '$nombre', '$contacto', '$correo', '$telefono')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Proveedores table
function eliminarProveedor($cpr)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Proveedores WHERE cpr = $cpr";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Proveedores table
function actualizarProveedor($cpr, $nombre, $contacto, $correo, $telefono)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Proveedores SET nombre='$nombre', contacto='$contacto', correo='$correo', telefono='$telefono' WHERE cpr='$cpr'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}



// Function to retrieve data from the Sucursal table
function obtenerSucursales()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Sucursal";

    $resultado = pg_query($conexion, $consulta);

    // Check if query was successful
    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $sucursales = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $sucursales;
}

// Usage example: Fetch all branches
$sucursales = obtenerSucursales();

// Display the retrieved data
foreach ($sucursales as $sucursal) {
    echo "CS: " . $sucursal['cs'] . ", Nombre: " . $sucursal['nombre'] . ", Dirección: " . $sucursal['direccion'] . "<br>";
}

// Function to insert data into the Sucursal table
function insertarSucursal($cs, $nombre, $direccion, $telefono, $correo)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Sucursal (cs, nombre, direccion, telefono, correo) VALUES ('$cs', '$nombre', '$direccion', '$telefono', '$correo')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Sucursal table
function eliminarSucursal($cs)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Sucursal WHERE cs = $cs";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Sucursal table
function actualizarSucursal($cs, $nombre, $direccion, $telefono, $correo)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Sucursal SET nombre='$nombre', direccion='$direccion', telefono='$telefono', correo='$correo' WHERE cs='$cs'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}









?>
>>>>>>> Stashed changes
