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

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarLibro($cl)
    {
        $stmt = $this->db->prepare("UPDATE Libros SET estado = false WHERE cl = :cl");
        $stmt->bindParam(':cl', $cl, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    public function handleGetRequest($cl = null)
    {
        if ($cl !== null) {
            $libro = $this->obtenerLibroPorId($cl);
            if ($libro) {
                echo json_encode($libro);
                http_response_code(200); 
            } else {
                echo json_encode(array("message" => "No se encontró el libro."));
                http_response_code(404); 
            }
        } else {
            $libros = $this->obtenerLibros();
            http_response_code(200); 
        }
    }

    public function handleDeleteRequest($cl)
    {
        if ($this->eliminarLibro($cl)) {
            echo json_encode(array("message" => "El libro se eliminó correctamente."));
            http_response_code(200); 
        } else {
            echo json_encode(array("message" => "No se pudo eliminar el libro."));
            http_response_code(500); 
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $libro = new Libro();

    $cl = $data['cl'];
    $genero = $data['genero'];
    $precio = $data['precio'];
    $titulo = $data['titulo'];
    $editorial = $data['editorial'];
    $anioPublicacion = $data['anioPublicacion'];
    $stock = $data['stock'];
    $sucursal = $data['sucursal'];

    if ($libro->actualizarLibro($cl, $genero, $precio, $titulo, $anioPublicacion, $stock, $editorial, $sucursal)) {
        echo json_encode(array("message" => "Los cambios se guardaron correctamente."));
        http_response_code(200); // OK
    } else {
        echo json_encode(array("message" => "No se pudieron guardar los cambios."));
        http_response_code(500); 
    }
}

$libro = new Libro();
// Verificar si la solicitud es DELETE
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cl = isset($_GET['cl']) ? $_GET['cl'] : null;
    $libro->handleGetRequest($cl);
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $cl = isset($_GET['cl']) ? $_GET['cl'] : null;
    if ($cl) {
        $libro->handleDeleteRequest($cl);
    } else {
        echo json_encode(array("message" => "Se requiere proporcionar un ID de libro válido."));
        http_response_code(400); 
    }
}
?>
