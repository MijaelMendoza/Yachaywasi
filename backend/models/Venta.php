<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class VentasModel {
    private $db;

    public function __construct() {
        $this->db = Conectarse();
    }

    public function insertarVenta($fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs) {
        $sql = "INSERT INTO Ventas (fecha_venta, forma_pago, cantidad, monto, Cliente_cu, Empleado_ca, Sucursal_cs) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(1, $fecha_venta, PDO::PARAM_STR);
        $stmt->bindParam(2, $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(3, $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(4, $monto, PDO::PARAM_STR);
        $stmt->bindParam(5, $cliente_cu, PDO::PARAM_INT);
        $stmt->bindParam(6, $empleado_ca, PDO::PARAM_INT);
        $stmt->bindParam(7, $sucursal_cs, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    
    public function insertarDetalleVenta($Ventas_cv, $Libros_cl, $precio_unitario) {
        $sql = "INSERT INTO detalle_venta (Ventas_cv, Libros_cl, precio_unitario) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $Ventas_cv, PDO::PARAM_INT);
        $stmt->bindParam(2, $Libros_cl, PDO::PARAM_INT);
        $stmt->bindParam(3, $precio_unitario, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function actualizarStockLibro($libroId, $cantidadVendida) {
        $sql = "SELECT stock FROM Libros WHERE cl=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $libroId, PDO::PARAM_INT);
        $stmt->execute();
        $stockActual = $stmt->fetchColumn();

        $nuevoStock = $stockActual - $cantidadVendida;

        $sql = "UPDATE Libros SET stock=? WHERE cl=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $nuevoStock, PDO::PARAM_INT);
        $stmt->bindParam(2, $libroId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    public function obtenerVentas() {
        $sql = "SELECT * FROM Ventas";
        $result = $this->db->query($sql);
        $ventas = array();
        while ($row = $result->fetch_assoc()) {
            $ventas[] = $row;
        }
        return $ventas;
    }

    public function actualizarVenta($cv, $fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs) {
        $sql = "UPDATE Ventas SET fecha_venta=?, forma_pago=?, cantidad=?, monto=?, Cliente_cu=?, Empleado_ca=?, Sucursal_cs=? WHERE cv=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $fecha_venta, PDO::PARAM_STR);
        $stmt->bindParam(2, $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(3, $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(4, $monto, PDO::PARAM_STR); // O PDO::PARAM_FLOAT
        $stmt->bindParam(5, $cliente_cu, PDO::PARAM_INT);
        $stmt->bindParam(6, $empleado_ca, PDO::PARAM_INT);
        $stmt->bindParam(7, $sucursal_cs, PDO::PARAM_INT);
        $stmt->bindParam(8, $cv, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    public function eliminarVenta($cv) {
        $sql = "DELETE FROM Ventas WHERE cv=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('i', $cv);
        return $stmt->execute();
    }
}
?>
