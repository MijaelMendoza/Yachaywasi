<?php
include_once 'C:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

class Libro
{
    private $db;

    public function __construct()
    {
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

    public function agregarLibro($genero, $precio, $titulo, $anioPublicacion, $stock, $Editorial_ce, $Sucursal_cs)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO Libros (genero, precio, titulo, anioPublicacion, stock, Editorial_ce, Sucursal_cs) VALUES (:genero, :precio, :titulo, :anioPublicacion, :stock, :Editorial_ce, :Sucursal_cs)");
            $stmt->bindParam(':genero', $genero);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':anioPublicacion', $anioPublicacion);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':Editorial_ce', $Editorial_ce);
            $stmt->bindParam(':Sucursal_cs', $Sucursal_cs);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function actualizarLibro($cl, $genero, $precio, $titulo, $anioPublicacion, $stock, $Editorial_ce, $Sucursal_cs)
    {
        $stmt = $this->db->prepare("UPDATE Libros SET genero = :genero, precio = :precio, titulo = :titulo, anioPublicacion = :anioPublicacion, stock = :stock, Editorial_ce = :Editorial_ce, Sucursal_cs = :Sucursal_cs WHERE cl = :cl");
        $stmt->bindParam(':cl', $cl, PDO::PARAM_INT);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':anioPublicacion', $anioPublicacion);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':Editorial_ce', $Editorial_ce);
        $stmt->bindParam(':Sucursal_cs', $Sucursal_cs);
        $stmt->execute();
    }

    public function eliminarLibro($cl)
    {
        $stmt = $this->db->prepare("DELETE FROM Libros WHERE cl = :cl");
        $stmt->bindParam(':cl', $cl, PDO::PARAM_INT);
        $stmt->execute();
    }
}
