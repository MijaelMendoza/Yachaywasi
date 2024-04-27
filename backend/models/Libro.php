<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class Libro
{
    private $db;

    public function __construct() {
        $this->db = Conectarse();
    }

    public function obtenerLibros()
    {
        $stmt = $this->db->prepare("SELECT * FROM Libros");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerLibroPorId($cl)
    {
        $stmt = $this->db->prepare("SELECT * FROM Libros WHERE cl = :cl");
        $stmt->bindParam(':cl', $cl, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function agregarLibro($nombre, $genero, $precio, $titulo, $editorial, $anioPublicacion, $stock, $Editorial_ce, $Sucursal_cs)
    {
        $stmt = $this->db->prepare("INSERT INTO Libros (nombre, genero, precio, titulo, editorial, anioPublicacion, stock, Editorial_ce, Sucursal_cs) VALUES (:nombre, :genero, :precio, :titulo, :editorial, :anioPublicacion, :stock, :Editorial_ce, :Sucursal_cs)");
        $stmt->execute();
    }

    public function actualizarLibro($cl, $nombre, $genero, $precio, $titulo, $editorial, $anioPublicacion, $stock, $Editorial_ce, $Sucursal_cs)
    {
        $stmt = $this->db->prepare("UPDATE Libros SET nombre = :nombre, genero = :genero, precio = :precio, titulo = :titulo, editorial = :editorial, anioPublicacion = :anioPublicacion, stock = :stock, Editorial_ce = :Editorial_ce, Sucursal_cs = :Sucursal_cs WHERE cl = :cl");
        $stmt->execute();
    }

    public function eliminarLibro($cl)
    {
        $stmt = $this->db->prepare("DELETE FROM Libros WHERE cl = :cl");
        $stmt->bindParam(':cl', $cl, PDO::PARAM_INT);
        $stmt->execute();
    }
}
