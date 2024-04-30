<?php
require_once '../../../backend/controllers/librosController.php';
include_once '../../../backend/core/conexion.php';
$editoriales = obtenerEditoriales();
$libroController = new LibroController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'registrar_libro') {
    if (empty($_POST['genero']) || empty($_POST['precio']) || empty($_POST['titulo']) || empty($_POST['anioPublicacion']) || empty($_POST['stock']) || empty($_POST['editorial'])) {
        echo "<script>alert('Todos los campos son obligatorios. Por favor, complete todos los campos.');</script>";
    } else {
        $genero = $_POST['genero'];
        $precio = $_POST['precio'];
        $titulo = $_POST['titulo'];
        $anioPublicacion = $_POST['anioPublicacion'];
        $stock = $_POST['stock'];
        $sucursal_cs = $_SESSION['user_sucursal'];
        $editorial_ce = $_POST['editorial'];

        $libroController->crearLibro([
            'genero' => $genero,
            'precio' => $precio,
            'titulo' => $titulo,
            'anioPublicacion' => $anioPublicacion,
            'stock' => $stock,
            'Editorial_ce' => $editorial_ce,
            'Sucursal_cs' => $sucursal_cs
        ]);

        echo "<script>alert('Libro registrado con éxito');</script>";
    }
}
?>

<!-- Ventana Modal de Registro de Libro -->
<div class="modal fade" id="registroLibroModal" tabindex="-1" aria-labelledby="registroLibroModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="registroLibroModalLabel">REGISTRAR LIBRO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Formulario de registro de libro -->
            <div class="modal-body">
                <form id="formularioLibro" method="POST" action="">
                    <div class="mb-3">
                        <label for="tituloLibro" class="form-label">Título</label>
                        <input type="text" class="form-control" id="tituloLibro" name="titulo" required
                            placeholder="Título del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="generoLibro" class="form-label">Género</label>
                        <input type="text" class="form-control" id="generoLibro" name="genero" required
                            placeholder="Género del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="precioLibro" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precioLibro" name="precio" required
                            placeholder="Precio del Libro">
                    </div>
                    <div class="mb-3">
                        <label for="editorialLibro" class="form-label">Editorial</label>
                        <select class="form-control" id="editorialLibro" name="editorial" required>
                            <?php foreach ($editoriales as $editorial): ?>
                                <option value="<?= htmlspecialchars($editorial['ce']) ?>">
                                    <?= htmlspecialchars($editorial['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="anioPublicacionLibro" class="form-label">Año de Publicación</label>
                        <input type="number" class="form-control" id="anioPublicacionLibro" name="anioPublicacion"
                            required placeholder="Año de Publicación">
                    </div>
                    <div class="mb-3">
                        <label for="stockLibro" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stockLibro" name="stock" required
                            placeholder="Stock del Libro">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="action" value="registrar_libro">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar Libro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>