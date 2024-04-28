<?php
include 'C:\xampp\htdocs\Yachaywasi\backend\models\Venta.php';

class VentasController {
    private $ventasModel;

    public function __construct() {
        $this->ventasModel = new VentasModel();
    }

    public function agregarVentaConDetalles($fecha_venta, $forma_pago, $monto, $cantidad, $cliente_cu, $empleado_ca, $sucursal_cs, $detalles) {
        try {
            if ($venta_id = $this->ventasModel->insertarVenta($fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs)) {
                foreach ($detalles as $detalle) {
                    if ($this->ventasModel->insertarDetalleVenta($venta_id, $detalle['libro_id'], $detalle['precio_unitario'])) {
                        $this->ventasModel->actualizarStockLibro($detalle['libro_id'], $detalle['cantidad']);
                    } else {
                        throw new Exception("Error al insertar el detalle de la venta.");
                    }
                }
                echo "Venta y detalles agregados correctamente.";
            } else {
                throw new Exception("Error al agregar la venta.");
            }
        } catch (Exception $e) {
            echo "Error al agregar la venta y los detalles: " . $e->getMessage();
        }
    }
    
    public function mostrarVentas() {
        $ventas = $this->ventasModel->obtenerVentas();
        if (!empty($ventas)) {
            foreach ($ventas as $venta) {
                echo "Venta #{$venta['cv']}: Fecha: {$venta['fecha_venta']}, Forma de pago: {$venta['forma_pago']}, Cantidad: {$venta['cantidad']}, Monto: {$venta['monto']}, Cliente: {$venta['Cliente_cu']}, Empleado: {$venta['Empleado_ca']}, Sucursal: {$venta['Sucursal_cs']}<br>";
            }
        } else {
            echo "No hay ventas registradas.";
        }
    }

    public function actualizarVenta($cv, $fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs) {
        if ($this->ventasModel->actualizarVenta($cv, $fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs)) {
            echo "Venta actualizada correctamente.";
        } else {
            echo "Error al actualizar la venta.";
        }
    }

    public function eliminarVenta($cv) {
        if ($this->ventasModel->eliminarVenta($cv)) {
            echo "Venta eliminada correctamente.";
        } else {
            echo "Error al eliminar la venta.";
        }
    }
}
?>
