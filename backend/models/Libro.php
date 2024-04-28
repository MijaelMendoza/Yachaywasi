<?php
include 'D:\xampp\htdocs\Yachaywasi\backend\core\conexion.php';

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
    $stmt = $this->db->prepare("UPDATE Libros SET nombre = :nombre, genero = :genero, precio = :precio, titulo = :titulo, editorial = :editorial, anioPublicacion = :anioPublicacion, stock = :stock, Sucursal_cs = :sucursal WHERE cl = :cl");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':precio', $precio);
    $stmt->bindParam(':titulo', $titulo);
    $stmt->bindParam(':editorial', $editorial);
    $stmt->bindParam(':anioPublicacion', $anioPublicacion);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':sucursal', $Sucursal_cs); // Agregar el parámetro para Sucursal_cs
    $stmt->bindParam(':cl', $cl);
    $stmt->execute();
}



    public function eliminarLibro($cl)
    {
        $stmt = $this->db->prepare("DELETE FROM Libros WHERE cl = :cl");
        $stmt->bindParam(':cl', $cl, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true; // Se eliminó correctamente
        } else {
            return false; // Error al eliminar
        }
    }
}
// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar los datos del formulario
    $cl = $_POST['cl'];
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $precio = $_POST['precio'];
    $titulo = $_POST['titulo'];
    $editorial = $_POST['editorial'];
    $anioPublicacion = $_POST['anioPublicacion'];
    $stock = $_POST['stock'];
    $sucursal = $_POST['sucursal'];

    // Crear una instancia de la clase Libro
    $libro = new Libro();

    // Intentar actualizar el libro
    if ($libro->actualizarLibro($cl, $nombre, $genero, $precio, $titulo, $editorial, $anioPublicacion, $stock, $sucursal)) {
        // Éxito al actualizar el libro
        echo json_encode(array("message" => "Los cambios se guardaron correctamente."));
        http_response_code(200); // OK
    } else {
        // Error al actualizar el libro
        echo json_encode(array("message" => "No se pudieron guardar los cambios."));
        http_response_code(500); // Error del servidor
    }
}


// Verificar si la solicitud es DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $cl = isset($_GET['cl']) ? $_GET['cl'] : null;
    if ($cl) {
        $libro = new Libro();
        if ($libro->eliminarLibro($cl)) {
            echo json_encode(array("message" => "El libro se eliminó correctamente."));
            http_response_code(200); 
        } else {
            echo json_encode(array("message" => "No se pudo eliminar el libro."));
            http_response_code(500);
        }
    } else {
        echo json_encode(array("message" => "Se requiere proporcionar un ID de libro válido."));
        http_response_code(400); 
    }
}
?>
