<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class Cliente
{
    private $db;

    public function __construct()
    {
        $this->db = Conectarse();
    }

    public function obtenerClientes()
    {
        $stmt = $this->db->prepare("SELECT * FROM Cliente WHERE estado = true");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerClientePorId($cu)
    {
        $stmt = $this->db->prepare("SELECT * FROM Cliente WHERE cu = :cu AND estado = true");
        $stmt->bindParam(':cu', $cu, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarCliente($nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente, $genero)
    {
        $stmt = $this->db->prepare("INSERT INTO Cliente (nombre, ci, direccion, telefono, correo, fecha_registro, segmento_cliente, estado, genero) VALUES (:nombre, :ci, :direccion, :telefono, :correo, :fecha_registro, :segmento_cliente, true, :genero)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':segmento_cliente', $segmento_cliente);
        $stmt->bindParam(':genero', $genero);
        $stmt->execute();
    }

    public function actualizarCliente($cu, $nombre, $ci, $direccion, $telefono, $correo, $fecha_registro, $segmento_cliente, $genero)
    {
        $stmt = $this->db->prepare("UPDATE Cliente SET nombre = :nombre, ci = :ci, direccion = :direccion, telefono = :telefono, correo = :correo, fecha_registro = :fecha_registro, segmento_cliente = :segmento_cliente, genero = :genero WHERE cu = :cu AND estado = true");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':fecha_registro', $fecha_registro);
        $stmt->bindParam(':segmento_cliente', $segmento_cliente);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':cu', $cu);
        $stmt->execute();
    }

    public function eliminarCliente($cu)
    {
        $stmt = $this->db->prepare("UPDATE Cliente SET estado = false WHERE cu = :cu AND estado = true");
        $stmt->bindParam(':cu', $cu, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function buscarClientePorCiOCorreo($ci, $correo) {
        $stmt = $this->db->prepare("SELECT cu FROM Cliente WHERE ci = :ci OR correo = :correo");
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }
}
?>