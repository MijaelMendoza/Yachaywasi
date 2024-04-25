<?php
require_once('../models/Proveedores.php');


class ProveedoresController {
    private $proveedoresModel;

    public function __construct() {
        $this->proveedoresModel = new ProveedoresModel();
    }

    public function agregarProveedor($nombre, $contacto, $correo, $telefono, $estado) {
        $estadoInt = $estado ? 1 : 0;
        if ($this->proveedoresModel->insertarProveedor($nombre, $contacto, $correo, $telefono, $estadoInt)) {
            echo "Proveedor agregado correctamente.";
        } else {
            echo "Error al agregar el proveedor.";
        }
    }

    public function mostrarProveedores() {
        $proveedores = $this->proveedoresModel->obtenerProveedores();
        if (!empty($proveedores)) {
            foreach ($proveedores as $proveedor) {
                echo "Proveedor #{$proveedor['cpr']}: Nombre: {$proveedor['nombre']}, Contacto: {$proveedor['contacto']}, Correo: {$proveedor['correo']}, Teléfono: {$proveedor['telefono']}, Estado: {$proveedor['estado']}<br>";
            }
        } else {
            echo "No hay proveedores registrados.";
        }
    }

    public function actualizarProveedor($cpr, $nombre, $contacto, $correo, $telefono, $estado) {
        $estadoInt = $estado ? 1 : 0;
        if ($this->proveedoresModel->actualizarProveedor($cpr, $nombre, $contacto, $correo, $telefono, $estadoInt)) {
            echo "Proveedor actualizado correctamente.";
        } else {
            echo "Error al actualizar el proveedor.";
        }
    }

    public function eliminarProveedor($cpr) {
        if ($this->proveedoresModel->eliminarProveedor($cpr)) {
            echo "Proveedor eliminado correctamente.";
        } else {
            echo "Error al eliminar el proveedor.";
        }
    }
}
?>
