<?php
require_once '../../../backend/controllers/librosController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accion']) && $_POST['accion'] === 'registrar_libro') {
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $precio = $_POST['precio'];
        $titulo = $_POST['titulo'];
        $editorial = $_POST['editorial'];
        $anioPublicacion = $_POST['anioPublicacion'];
        $stock = $_POST['stock'];

        $libroController = new LibroController();

        $libroController->crearLibro([
            'nombre' => $nombre,
            'genero' => $genero,
            'precio' => $precio,
            'titulo' => $titulo,
            'editorial' => $editorial,
            'anioPublicacion' => $anioPublicacion,
            'stock' => $stock
        ]);
    }
}
?>

<!-- Ventana Modal de Registro de Libro -->
<div class="modal fade" id="registroLibroModal" tabindex="-1" aria-labelledby="registroLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroLibroModalLabel">REGISTRAR LIBRO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de libro -->
            <div class="modal-body">
                <form id="formularioLibro" action="../Registros/registrar_libro.php" method="post">
                    <div class="mb-3">
                        <label for="nombreLibro" class="form-label">Nombre del Libro</label>
                        <input type="text" class="form-control" id="nombreLibro" name="nombre" required placeholder="Nombre del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="generoLibro" class="form-label">Género</label>
                        <input type="text" class="form-control" id="generoLibro" name="genero" required placeholder="Género del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="precioLibro" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precioLibro" name="precio" required placeholder="Precio del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="tituloLibro" class="form-label">Título</label>
                        <input type="text" class="form-control" id="tituloLibro" name="titulo" required placeholder="Título del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="editorialLibro" class="form-label">Editorial</label>
                        <input type="text" class="form-control" id="editorialLibro" name="editorial" required placeholder="Editorial del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="anioPublicacionLibro" class="form-label">Año de Publicación</label>
                        <input type="number" class="form-control" id="anioPublicacionLibro" name="anioPublicacion" required placeholder="Año de Publicación">
                    </div>
                    <div class="mb-3">
                        <label for="stockLibro" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stockLibro" name="stock" required placeholder="Stock del Libro">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar Libro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>