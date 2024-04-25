<?php
include 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class VentasModel {
    private $db;

    public function __construct() {
        $this->db = Conectarse();
    }

    public function insertarVenta($fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs) {
        $sql = "INSERT INTO Ventas (fecha_venta, forma_pago, cantidad, monto, Cliente_cu, Empleado_ca, Sucursal_cs) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssidiid', $fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs);
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
        $stmt->bind_param('ssidiidi', $fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs, $cv);
        return $stmt->execute();
    }

    public function eliminarVenta($cv) {
        $sql = "DELETE FROM Ventas WHERE cv=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $cv);
        return $stmt->execute();
    }
}
?>
