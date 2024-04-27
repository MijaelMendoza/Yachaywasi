<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class Empleado
{
    private $db;

    public function __construct()
    {
        $this->db = Conectarse();
    }

    public function obtenerEmpleados()
    {
        $stmt = $this->db->prepare("SELECT * FROM Empleado");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerEmpleadoPorId($ca)
    {
        $stmt = $this->db->prepare("SELECT * FROM Empleado WHERE ca = :ca");
        $stmt->bindParam(':ca', $ca, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarEmpleado($nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $estado, $Sucursal_cs)
    {
        $stmt = $this->db->prepare("INSERT INTO Empleado (nombre, ci, password, direccion, telefono, correo, cargo, fecha_contratacion, salario, estado, Sucursal_cs) VALUES (:nombre, :ci, :password, :direccion, :telefono, :correo, :cargo, :fecha_contratacion, :salario, :estado, :Sucursal_cs)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':fecha_contratacion', $fecha_contratacion);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_BOOL);
        $stmt->bindParam(':Sucursal_cs', $Sucursal_cs, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function actualizarEmpleado($ca, $nombre, $ci, $password, $direccion, $telefono, $correo, $cargo, $fecha_contratacion, $salario, $estado, $Sucursal_cs)
    {
        $stmt = $this->db->prepare("UPDATE Empleado SET nombre = :nombre, ci = :ci, password = :password, direccion = :direccion, telefono = :telefono, correo = :correo, cargo = :cargo, fecha_contratacion = :fecha_contratacion, salario = :salario, estado = :estado, Sucursal_cs = :Sucursal_cs WHERE ca = :ca");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ci', $ci);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':fecha_contratacion', $fecha_contratacion);
        $stmt->bindParam(':salario', $salario);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_BOOL);
        $stmt->bindParam(':Sucursal_cs', $Sucursal_cs, PDO::PARAM_INT);
        $stmt->bindParam(':ca', $ca);
        $stmt->execute();
    }

    public function eliminarEmpleado($ca)
    {
        $stmt = $this->db->prepare("UPDATE Empleado WHERE ca = :ca SET estado = false");
        $stmt->bindParam(':ca', $ca, PDO::PARAM_INT);
        $stmt->execute();
    }
}
