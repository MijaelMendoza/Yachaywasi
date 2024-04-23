<?php
require_once '../models/Empleado.php';

class EmpleadoController {
    private $empleadoModel;

    public function __construct() {
        $this->empleadoModel = new Empleado();
    }

    public function listarEmpleados() {
        $empleados = $this->empleadoModel->obtenerEmpleados();
        echo json_encode($empleados);
    }

    public function mostrarEmpleado($ca) {
        $empleado = $this->empleadoModel->obtenerEmpleadoPorId($ca);
        echo json_encode($empleado);
    }

    public function crearEmpleado($datosEmpleado) {
        $this->empleadoModel->agregarEmpleado($datosEmpleado['nombre'], $datosEmpleado['ci'], $datosEmpleado['password'], $datosEmpleado['direccion'], $datosEmpleado['telefono'], $datosEmpleado['correo'], $datosEmpleado['cargo'], $datosEmpleado['fecha_contratacion'], $datosEmpleado['salario'], $datosEmpleado['estado'], $datosEmpleado['Sucursal_cs']);
        echo "Empleado creado exitosamente!";
    }

    public function actualizarEmpleado($ca, $datosEmpleado) {
        $this->empleadoModel->actualizarEmpleado($ca, $datosEmpleado['nombre'], $datosEmpleado['ci'], $datosEmpleado['password'], $datosEmpleado['direccion'], $datosEmpleado['telefono'], $datosEmpleado['correo'], $datosEmpleado['cargo'], $datosEmpleado['fecha_contratacion'], $datosEmpleado['salario'], $datosEmpleado['estado'], $datosEmpleado['Sucursal_cs']);
        echo "Empleado actualizado exitosamente!";
    }

    public function eliminarEmpleado($ca) {
        $this->empleadoModel->eliminarEmpleado($ca);
        echo "Empleado eliminado exitosamente!";
    }
}
?>
