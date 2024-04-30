<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class PedidosProveedoresModel {
    var $db;

    public function __construct() {
        $this->db = Conectarse();
    }

    // Método para insertar un pedido
    public function insertarPedidoProveedor($forma_pago, $cantidad, $monto, $fecha_pedido, $fecha_recepcion, $Proveedores_cpr) {
        $sql = "INSERT INTO Pedidos_proveedores (forma_pago, cantidad, monto, fecha_pedido, fecha_recepcion, Proveedores_cpr) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(1, $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(2, $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(3, $monto, PDO::PARAM_STR); // O PDO::PARAM_FLOAT
        $stmt->bindParam(4, $fecha_pedido, PDO::PARAM_STR);
        $stmt->bindParam(5, $fecha_recepcion, PDO::PARAM_STR);
        $stmt->bindParam(6, $Proveedores_cpr, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // Método para insertar detalles del pedido
    public function insertarDetallePedido($Pedidos_cpe, $Libros_cl, $precio_unitario) {
        $sql = "INSERT INTO pedidos_proveedores_libros (Pedidos_proveedores_cpep, Libros_cl, precio_unitario) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(1, $Pedidos_cpe, PDO::PARAM_INT);
        $stmt->bindParam(2, $Libros_cl, PDO::PARAM_INT);
        $stmt->bindParam(3, $precio_unitario, PDO::PARAM_STR); // O PDO::PARAM_FLOAT

        return $stmt->execute();
    }
    
    public function obtenerPedidosProveedores() {
        $sql = "SELECT * FROM Pedidos_proveedores";
        $result = $this->db->query($sql);
        $pedidos = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $pedidos[] = $row;
        }
        return $pedidos;
    }

    public function actualizarPedidoProveedor($cpep, $forma_pago, $cantidad, $monto, $fecha_pedido, $fecha_recepcion, $Proveedores_cpr) {
        $sql = "UPDATE Pedidos_proveedores SET forma_pago=?, cantidad=?, monto=?, fecha_pedido=?, fecha_recepcion=?, Proveedores_cpr=? WHERE cpep=?";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(1, $forma_pago, PDO::PARAM_STR);
        $stmt->bindParam(2, $cantidad, PDO::PARAM_INT);
        $stmt->bindParam(3, $monto, PDO::PARAM_STR); // O PDO::PARAM_FLOAT
        $stmt->bindParam(4, $fecha_pedido, PDO::PARAM_STR);
        $stmt->bindParam(5, $fecha_recepcion, PDO::PARAM_STR);
        $stmt->bindParam(6, $Proveedores_cpr, PDO::PARAM_INT);
        $stmt->bindParam(7, $cpep, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function eliminarPedidoProveedor($cpep) {
        $sql = "DELETE FROM Pedidos_proveedores WHERE cpep=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $cpep, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
