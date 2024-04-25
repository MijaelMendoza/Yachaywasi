<?php
class Cliente {
    private $db;

    public function __construct() {
        $this->db = require_once __DIR__ . '/../core/conexion.php';
    }

    public function obtenerClientes() {
        $stmt = $this->db->prepare("SELECT * FROM Cliente");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerClientePorId($cu) {
        $stmt = $this->db->prepare("SELECT * FROM Cliente WHERE cu = :cu");
        $stmt->bindParam(':cu', $cu, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarCliente($nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente) {
        $stmt = $this->db->prepare("INSERT INTO Cliente (nombre, ci, direccion, telefono, correo, fecha_registro, segmento_cliente) VALUES (:nombre, :ci, :direccion, :telefono, :correo, :fecha_registro, :segmento_cliente)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':segmento_cliente', $segmento_cliente);
        $stmt->execute();
    }

    public function actualizarCliente($cu, $nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente) {
        $stmt = $this->db->prepare("UPDATE Cliente SET nombre = :nombre, ci = :ci, direccion = :direccion, telefono = :telefono, correo = :correo, fecha_registro = :fecha_registro, segmento_cliente = :segmento_cliente WHERE cu = :cu");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':segmento_cliente', $segmento_cliente);
        $stmt->bindParam(':cu', $cu);
        $stmt->execute();
    }

    public function eliminarCliente($cu) {
        $stmt = $this->db->prepare("UPDATE Cliente SET estado = false WHERE cu = :cu ");
        $stmt->bindParam(':cu', $cu, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
