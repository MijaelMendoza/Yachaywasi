<?php
include 'C:\xampp\htdocs\Yachaywasi\backend\models\Libro.php';

class LibroController
{
    private $libroModel;

    public function __construct()
    {
        $this->libroModel = new Libro();
    }

    public function listarLibros()
    {
        $libros = $this->libroModel->obtenerLibros();
        return json_encode($libros);
    }

    public function mostrarLibro($cl)
    {
        $libro = $this->libroModel->obtenerLibroPorId($cl);
        return json_encode($libro);
    }

    public function crearLibro($datosLibro)
    {
        $resultado = $this->libroModel->agregarLibro(
            $datosLibro['genero'], 
            $datosLibro['precio'], 
            $datosLibro['titulo'], 
            $datosLibro['anioPublicacion'], 
            $datosLibro['stock'], 
            $datosLibro['Editorial_ce'], 
            $datosLibro['Sucursal_cs']
        );
        //echo $resultado ? "Libro creado exitosamente!" : "Error al crear libro.";
    }

    public function actualizarLibro($cl, $datosLibro)
    {
        $resultado = $this->libroModel->actualizarLibro(
            $cl, 
            $datosLibro['genero'], 
            $datosLibro['precio'], 
            $datosLibro['titulo'], 
            $datosLibro['anioPublicacion'], 
            $datosLibro['stock'], 
            $datosLibro['Editorial_ce'], 
            $datosLibro['Sucursal_cs']
        );
        echo $resultado ? "Libro actualizado exitosamente!" : "Error al actualizar libro.";
    }

    public function eliminarLibro($cl)
    {
        $resultado = $this->libroModel->eliminarLibro($cl);
        echo $resultado ? "Libro eliminado exitosamente!" : "Error al eliminar libro.";
    }
}