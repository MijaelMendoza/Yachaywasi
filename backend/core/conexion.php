
<?php 

// Function to connect to the database
function Conectarse(){
    $host = 'localhost';
    $usuario = 'postgres';
    $contrasena = '2455';
    $nombre_bd = 'yachaywasi';
    try {
        $conn = @new PDO("pgsql:host=$host;dbname=$nombre_bd;user=$usuario;password=$contrasena");
    } catch (Exception $e) {
        echo "sdsa";
        echo $e->getMessage();
    }
    return $conn;
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



// Function to insert data into the Empleado table
function insertarEmpleado($ca, $nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $estado, $sucursal)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Empleado (ca, nombre, ci, password, direccion, telefono, correo, cargo, fecha_contratacion, salario, estado, sucursal) VALUES ('$ca', '$nombre', '$ci', '$password', '$direccion', '$telefono', '$correo', '$cargo', '$fecha_contratacion', '$salario', '$estado', '$sucursal')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Empleado table
function eliminarEmpleado($ca)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Empleado WHERE ca = $ca";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Empleado table
function actualizarEmpleado($ca, $nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $estado, $sucursal)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Empleado SET nombre='$nombre', ci='$ci', password='$password', direccion='$direccion', telefono='$telefono', correo='$correo', cargo='$cargo', fecha_contratacion='$fecha_contratacion', salario='$salario', estado='$estado', sucursal='$sucursal' WHERE ca='$ca'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}


// Function to retrieve data from the Empleado table
function obtenerEmpleados()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Empleado";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $empleados = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $empleados;
}


// Function to insert data into the Pedidos_proveedores table
function insertarPedidoProveedor($cpep, $cantidad, $fecha_pedido, $fecha_recepcion, $proveedores)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Pedidos_proveedores (cpep, cantidad, fecha_pedido, fecha_recepcion, proveedores) VALUES ('$cpep', '$cantidad', '$fecha_pedido', '$fecha_recepcion', '$proveedores')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Pedidos_proveedores table
function eliminarPedidoProveedor($cpep)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Pedidos_proveedores WHERE cpep = $cpep";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Pedidos_proveedores table
function actualizarPedidoProveedor($cpep, $cantidad, $fecha_pedido, $fecha_recepcion, $proveedores)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Pedidos_proveedores SET cantidad='$cantidad', fecha_pedido='$fecha_pedido', fecha_recepcion='$fecha_recepcion', proveedores='$proveedores' WHERE cpep='$cpep'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}



// Function to retrieve data from the Pedidos_proveedores table
function obtenerPedidosProveedores()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Pedidos_proveedores";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $pedidosProveedores = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $pedidosProveedores;
}



// Function to insert data into the Ventas table
function insertarVenta($cv, $fecha_venta, $forma_pago, $cantidad, $monto, $cliente, $empleado, $sucursal)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Ventas (cv, fecha_venta, forma_pago, cantidad, monto, cliente, empleado, sucursal) VALUES ('$cv', '$fecha_venta', '$forma_pago', '$cantidad', '$monto', '$cliente', '$empleado', '$sucursal')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Ventas table
function eliminarVenta($cv)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Ventas WHERE cv = $cv";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Ventas table
function actualizarVenta($cv, $fecha_venta, $forma_pago, $cantidad, $monto, $cliente, $empleado, $sucursal)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Ventas SET fecha_venta='$fecha_venta', forma_pago='$forma_pago', cantidad='$cantidad', monto='$monto', cliente='$cliente', empleado='$empleado', sucursal='$sucursal' WHERE cv='$cv'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the Ventas table
function obtenerVentas()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Ventas";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $ventas = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $ventas;
}



// Function to insert data into the Libros table
function insertarLibro($cl, $nombre, $genero, $precio, $titulo, $anioPublicacion, $stock, $editorial, $sucursal)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Libros (cl, nombre, genero, precio, titulo, anioPublicacion, stock, editorial, sucursal) VALUES ('$cl', '$nombre', '$genero', '$precio', '$titulo', '$anioPublicacion', '$stock', '$editorial', '$sucursal')";

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
function actualizarLibro($cl, $nombre, $genero, $precio, $titulo, $anioPublicacion, $stock, $editorial, $sucursal)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Libros SET nombre='$nombre', genero='$genero', precio='$precio', titulo='$titulo', anioPublicacion='$anioPublicacion', stock='$stock', editorial='$editorial', sucursal='$sucursal' WHERE cl='$cl'";

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



// Function to insert data into the Pedidos table
function insertarPedido($cpe, $cantidad, $fecha, $forma_pago, $monto, $cliente, $sucursal, $empleado)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Pedidos (cpe, cantidad, fecha, forma_pago, monto, cliente, sucursal, empleado) VALUES ('$cpe', '$cantidad', '$fecha', '$forma_pago', '$monto', '$cliente', '$sucursal', '$empleado')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Pedidos table
function eliminarPedido($cpe)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Pedidos WHERE cpe = $cpe";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Pedidos table
function actualizarPedido($cpe, $cantidad, $fecha, $forma_pago, $monto, $cliente, $sucursal, $empleado)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Pedidos SET cantidad='$cantidad', fecha='$fecha', forma_pago='$forma_pago', monto='$monto', cliente='$cliente', sucursal='$sucursal', empleado='$empleado' WHERE cpe='$cpe'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the Pedidos table
function obtenerPedidos()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Pedidos";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $pedidos = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $pedidos;
}



// Function to insert data into the reviews table
function insertarReview($cr, $ratings, $comentario, $fecha_review, $libros)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO reviews (cr, ratings, comentario, fecha_review, libros) VALUES ('$cr', '$ratings', '$comentario', '$fecha_review', '$libros')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the reviews table
function eliminarReview($cr)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM reviews WHERE cr = $cr";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the reviews table
function actualizarReview($cr, $ratings, $comentario, $fecha_review, $libros)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE reviews SET ratings='$ratings', comentario='$comentario', fecha_review='$fecha_review', libros='$libros' WHERE cr='$cr'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the reviews table
function obtenerReviews()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM reviews";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $reviews = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $reviews;
}



// Function to insert data into the Envios table
function insertarEnvio($cen, $fecha_envio, $fecha_estimada_entrega, $fecha_real_entrega, $estado, $metodo, $costo, $direccion, $observaciones, $pedidos)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO Envios (cen, fecha_envio, fecha_estimada_entrega, fecha_real_entrega, estado, metodo, costo, direccion, observaciones, pedidos) VALUES ('$cen', '$fecha_envio', '$fecha_estimada_entrega', '$fecha_real_entrega', '$estado', '$metodo', '$costo', '$direccion', '$observaciones', '$pedidos')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the Envios table
function eliminarEnvio($cen)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM Envios WHERE cen = $cen";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the Envios table
function actualizarEnvio($cen, $fecha_envio, $fecha_estimada_entrega, $fecha_real_entrega, $estado, $metodo, $costo, $direccion, $observaciones, $pedidos)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE Envios SET fecha_envio='$fecha_envio', fecha_estimada_entrega='$fecha_estimada_entrega', fecha_real_entrega='$fecha_real_entrega', estado='$estado', metodo='$metodo', costo='$costo', direccion='$direccion', observaciones='$observaciones', pedidos='$pedidos' WHERE cen='$cen'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the Envios table
function obtenerEnvios()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM Envios";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $envios = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $envios;
}




// Function to insert data into the detalle_pedido table
function insertarDetallePedido($cdo, $libros, $pedidos)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO detalle_pedido (cdo, libros, pedidos) VALUES ('$cdo', '$libros', '$pedidos')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the detalle_pedido table
function eliminarDetallePedido($cdo)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM detalle_pedido WHERE cdo = $cdo";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the detalle_pedido table
function actualizarDetallePedido($cdo, $libros, $pedidos)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE detalle_pedido SET libros='$libros', pedidos='$pedidos' WHERE cdo='$cdo'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the detalle_pedido table
function obtenerDetallePedidos()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM detalle_pedido";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $detallePedidos = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $detallePedidos;
}




// Function to insert data into the detalle_venta table
function insertarDetalleVenta($cdv, $precio_unitario, $ventas, $libros)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO detalle_venta (cdv, precio_unitario, ventas, libros) VALUES ('$cdv', '$precio_unitario', '$ventas', '$libros')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the detalle_venta table
function eliminarDetalleVenta($cdv)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM detalle_venta WHERE cdv = $cdv";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the detalle_venta table
function actualizarDetalleVenta($cdv, $precio_unitario, $ventas, $libros)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE detalle_venta SET precio_unitario='$precio_unitario', ventas='$ventas', libros='$libros' WHERE cdv='$cdv'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the detalle_venta table
function obtenerDetalleVentas()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM detalle_venta";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $detalleVentas = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $detalleVentas;
}


// Function to insert data into the pedidos_proveedores_libros table
function insertarPedidoProveedorLibro($cppl, $pedidos_proveedores, $libros)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "INSERT INTO pedidos_proveedores_libros (cppl, pedidos_proveedores, libros) VALUES ('$cppl', '$pedidos_proveedores', '$libros')";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al insertar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to delete data from the pedidos_proveedores_libros table
function eliminarPedidoProveedorLibro($cppl)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "DELETE FROM pedidos_proveedores_libros WHERE cppl = $cppl";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al eliminar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to update data in the pedidos_proveedores_libros table
function actualizarPedidoProveedorLibro($cppl, $pedidos_proveedores, $libros)
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "UPDATE pedidos_proveedores_libros SET pedidos_proveedores='$pedidos_proveedores', libros='$libros' WHERE cppl='$cppl'";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error al actualizar datos.";
        exit();
    }

    pg_close($conexion);
}

// Function to retrieve data from the pedidos_proveedores_libros table
function obtenerPedidosProveedorLibros()
{
    $conexion = Conectarse();

    if (!$conexion) {
        echo "<h1>No se puede conectar a la base de datos.</h1>";
        exit();
    }

    $consulta = "SELECT * FROM pedidos_proveedores_libros";

    $resultado = pg_query($conexion, $consulta);

    if (!$resultado) {
        echo "Error en la consulta.";
        exit();
    }

    // Fetch data from the result set
    $pedidosProveedorLibros = pg_fetch_all($resultado);

    // Close connection
    pg_close($conexion);

    return $pedidosProveedorLibros;
}

?>

