<?php
include 'C:\xampp\htdocs\Yachaywasi\backend\models\Cliente.php';


class ClienteController {
    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
    }

    public function listarClientes() {
        $clientes = $this->clienteModel->obtenerClientes();
        return json_encode($clientes);
    }

    public function mostrarCliente($cu) {
        $cliente = $this->clienteModel->obtenerClientePorId($cu);
        return json_encode($cliente);
    }

    public function crearCliente($datosCliente) {
        $this->clienteModel->agregarCliente($datosCliente['nombre'], $datosCliente['ci'], $datosCliente['direccion'], $datosCliente['telefono'], $datosCliente['correo'], $datosCliente['fecha_registro'], $datosCliente['segmento_cliente']);
        echo "Cliente creado exitosamente!";
    }

    public function actualizarCliente($cu, $datosCliente) {
        $this->clienteModel->actualizarCliente($cu, $datosCliente['nombre'], $datosCliente['ci'], $datosCliente['direccion'], $datosCliente['telefono'], $datosCliente['correo'], $datosCliente['fecha_registro'], $datosCliente['segmento_cliente']);
        echo "Cliente actualizado exitosamente!";
    }

    public function eliminarCliente($cu) {
        $this->clienteModel->eliminarCliente($cu);
        echo "Cliente eliminado exitosamente!";
    }
}
?>
