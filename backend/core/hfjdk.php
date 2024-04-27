
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

function insertarLibro($nombre, $genero, $precio, $titulo, $editorial, $anioPublicacion, $stock, $Editorial_ce, $Sucursal_cs)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Libros (nombre, genero, precio, titulo, editorial, anioPublicacion, stock, Editorial_ce, Sucursal_cs) VALUES ('$nombre', '$genero', '$precio', '$titulo', '$editorial', '$anioPublicacion', '$stock', '$Editorial_ce', '$Sucursal_cs')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Libros table
function eliminarLibro($cl)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Libros WHERE cl = $cl";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Libros table
function actualizarLibro($cl, $nombre, $genero, $precio, $titulo, $editorial, $anioPublicacion, $stock, $Editorial_ce, $Sucursal_cs)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Libros SET nombre='$nombre', genero='$genero', precio='$precio', titulo='$titulo', editorial='$editorial', anioPublicacion='$anioPublicacion', stock='$stock', Editorial_ce='$Editorial_ce', Sucursal_cs='$Sucursal_cs' WHERE cl='$cl'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the Libros table
function obtenerLibros()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Libros";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $libros = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $libros;
}

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
