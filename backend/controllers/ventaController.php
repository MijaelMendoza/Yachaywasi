<?php
require_once('../models/Venta.php');

class VentasController {
    private $ventasModel;

    public function __construct() {
        $this->ventasModel = new VentasModel();
    }

    public function agregarVenta($fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs) {
        if ($this->ventasModel->insertarVenta($fecha_venta, $forma_pago, $cantidad, $monto, $cliente_cu, $empleado_ca, $sucursal_cs)) {
            echo "Venta agregada correctamente.";
        } else {
            echo "Error al agregar la venta.";
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
