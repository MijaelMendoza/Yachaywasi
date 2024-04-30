<?php
include 'C:\xampp\htdocs\Yachaywasi\backend\models\PedidosProveedores.php';

class PedidosProveedoresController {
    private $pedidosProveedoresModel;

    public function __construct() {
        $this->pedidosProveedoresModel = new PedidosProveedoresModel();
    }

    public function agregarPedidoConDetalles($forma_pago, $cantidad, $monto, $fecha_pedido, $fecha_recepcion, $Proveedores_cpr, $detalles) {
        try {
            $pdo = $this->pedidosProveedoresModel->db;
            $pdo->beginTransaction();
            if ($pedido_id = $this->pedidosProveedoresModel->insertarPedidoProveedor($forma_pago, $cantidad, $monto, $fecha_pedido, $fecha_recepcion, $Proveedores_cpr)) {
                foreach ($detalles as $detalle) {
                    if (!$this->pedidosProveedoresModel->insertarDetallePedido($pedido_id, $detalle['libro_id'], $detalle['precio_unitario'])) {
                        throw new Exception("Error al insertar el detalle del pedido.");
                    }
                }
                $pdo->commit();
                echo "Pedido y detalles agregados correctamente.";
            } else {
                $pdo->rollBack();
                throw new Exception("Error al agregar el pedido.");
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "Error al agregar el pedido y los detalles: " . $e->getMessage();
        }
    }
    
    public function mostrarPedidos() {
        $pedidos = $this->pedidosProveedoresModel->obtenerPedidosProveedores();
        return json_encode($pedidos);
    }

    public function actualizarPedido($cpep, $forma_pago, $cantidad, $monto, $fecha_pedido, $fecha_recepcion, $Proveedores_cpr) {
        if ($this->pedidosProveedoresModel->actualizarPedidoProveedor($cpep, $forma_pago, $cantidad, $monto, $fecha_pedido, $fecha_recepcion, $Proveedores_cpr)) {
            echo "Pedido actualizado correctamente.";
        } else {
            echo "Error al actualizar el pedido.";
        }
    }

    public function eliminarPedido($cpep) {
        if ($this->pedidosProveedoresModel->eliminarPedidoProveedor($cpep)) {
            echo "Pedido eliminado correctamente.";
        } else {
            echo "Error al eliminar el pedido.";
        }
    }
}
?>
