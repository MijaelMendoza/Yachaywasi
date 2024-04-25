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
        $this->libroModel->agregarLibro($datosLibro['nombre'], $datosLibro['genero'], $datosLibro['precio'], $datosLibro['titulo'], $datosLibro['editorial'], $datosLibro['anioPublicacion'], $datosLibro['stock'], $datosLibro['Editorial_ce'], $datosLibro['Sucursal_cs']);
        echo "Libro creado exitosamente!";
    }

    public function actualizarLibro($cl, $datosLibro)
    {
        $this->libroModel->actualizarLibro($cl, $datosLibro['nombre'], $datosLibro['genero'], $datosLibro['precio'], $datosLibro['titulo'], $datosLibro['editorial'], $datosLibro['anioPublicacion'], $datosLibro['stock'], $datosLibro['Editorial_ce'], $datosLibro['Sucursal_cs']);
        echo "Libro actualizado exitosamente!";
    }

    public function eliminarLibro($cl)
    {
        $this->libroModel->eliminarLibro($cl);
        echo "Libro eliminado exitosamente!";
    }
}
