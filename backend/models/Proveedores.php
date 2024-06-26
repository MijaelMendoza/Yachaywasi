<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class ProveedoresModel
{
    private $db;

    public function __construct()
    {
        $this->db = Conectarse();
    }

    public function insertarProveedor($nombre, $contacto, $correo, $telefono, $estado)
    {
        $sql = "INSERT INTO Proveedores (nombre, contacto, correo, telefono, estado) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssi', $nombre, $contacto, $correo, $telefono, $estado);
        return $stmt->execute();
    }
 
    public function obtenerProveedores()
    {
        $stmt = $this->db->prepare("SELECT * FROM Proveedores WHERE estado = true");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarProveedor($cpr, $nombre, $contacto, $correo, $telefono, $estado)
    {
        $sql = "UPDATE Proveedores SET nombre=?, contacto=?, correo=?, telefono=?, estado=? WHERE cpr=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ssssii', $nombre, $contacto, $correo, $telefono, $estado, $cpr);
        return $stmt->execute();
    }

    public function eliminarProveedor($cpr)
    {
        $sql = "UPDATE Proveedores SET estado = false WHERE cpr=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $cpr);
        return $stmt->execute();
    }
}
