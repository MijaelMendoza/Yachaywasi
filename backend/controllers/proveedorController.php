<?php
include 'C:\xampp\htdocs\Yachaywasi\backend\models\Proveedores.php';

class ProveedoresController
{
    private $proveedoresModel;

    public function __construct()
    {
        $this->proveedoresModel = new ProveedoresModel();
    }

    public function agregarProveedor($nombre, $contacto, $correo, $telefono, $estado)
    {
        $estadoInt = $estado ? 1 : 0;
        if ($this->proveedoresModel->insertarProveedor($nombre, $contacto, $correo, $telefono, $estadoInt)) {
            echo "Proveedor agregado correctamente.";
        } else {
            echo "Error al agregar el proveedor.";
        }
    }

    public function mostrarProveedores()
    {
        $proveedores = $this->proveedoresModel->obtenerProveedores();
        return json_encode($proveedores);
    }

    public function actualizarProveedor($cpr, $nombre, $contacto, $correo, $telefono, $estado)
    {
        $estadoInt = $estado ? 1 : 0;
        if ($this->proveedoresModel->actualizarProveedor($cpr, $nombre, $contacto, $correo, $telefono, $estadoInt)) {
            echo "Proveedor actualizado correctamente.";
        } else {
            echo "Error al actualizar el proveedor.";
        }
    }

    public function eliminarProveedor($cpr)
    {
        if ($this->proveedoresModel->eliminarProveedor($cpr)) {
            echo "Proveedor eliminado correctamente.";
        } else {
            echo "Error al eliminar el proveedor.";
        }
    }
}
