<?php
require_once '../../../backend/controllers/librosController.php';
include '../templates/header.php';
$libroController = new LibroController();

// Obtén la lista de libros
$libros = json_decode($libroController->listarLibros(), true);
?>
<div class="container mt-5">
    <!-- Título de la sección -->
    <div class="text-center bg-danger text-white p-2">
        <h2>REGISTRAR VENTA</h2>
    </div>

    <!-- Formulario de registro de ventas -->
    <form class="mt-4">
        <div class="row mb-3">
            <!-- Campo de Nombre del Libro -->
            <div class="col">
                <select name="libro_id" class="form-select" aria-label="Selecciona un libro">
                    <option selected>Selecciona un libro</option>
                    <?php foreach ($libros as $libro): ?>
                        <option value="<?php echo htmlspecialchars($libro['id']); ?>">
                            <?php echo htmlspecialchars($libro['titulo']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Campo de Fecha -->
            <div class="col">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha">
            </div>
        </div>
        <div class="row mb-3">
            <!-- Campo de Forma de Pago -->
            <div class="col">
                <label for="formaPago" class="form-label">Forma de Pago</label>
                <select class="form-select" id="formaPago">
                    <option selected>Seleccione...</option>
                    <option value="1">Efectivo</option>
                    <option value="2">Tarjeta</option>
                </select>
            </div>
            <!-- Campo de Nombre del Cliente -->
            <div class="col">
                <label for="nombreCliente" class="form-label">Nombre Cliente</label>
                <input type="text" class="form-control" id="nombreCliente" placeholder="Placeholder">
            </div>
        </div>
        <div class="mb-3">
            <!-- Campo de Monto -->
            <label for="monto" class="form-label">Monto</label>
            <input type="text" class="form-control" id="monto" placeholder="Placeholder">
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Botones de acción -->
            <button type="submit" class="btn btn-secondary me-md-2">CANCELAR</button>
            <button type="submit" class="btn btn-primary">REGISTRAR</button>
        </div>
    </form>
</div>

<?php include '../templates/footer.php'; ?>