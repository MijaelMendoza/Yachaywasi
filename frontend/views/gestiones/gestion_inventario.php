<?php 
require_once '../../../backend/models/Libro.php';
include '../templates/header.php';
require_once '../../../backend/core/Conexion.php';  

?>

<div class="max-w-6xl mx-auto p-8">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">INVENTARIO</h1>
    <div class="relative">
      <input
        type="text"
        id="searchInput"
        class="border border-zinc-300 dark:border-zinc-700 p-3 rounded-md"
        placeholder="Search"
        oninput="filterTable()"
      />
      <button class="absolute right-2 top-2 text-zinc-600 dark:text-zinc-400" onclick="filterTable()">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15.75 15.75L19.5 19.5m-6.75-3.75a6 6 0 1112 0 6 6 0 01-12 0z"
          />
        </svg>
      </button>
    </div>
  </div>
  <div class="overflow-x-auto">
    <table id="inventoryTable" class="w-full text-left border-collapse">
      <thead>
        <tr>
          <th class="border-b-2 p-4">ID</th>
          <th class="border-b-2 p-4">Nombre</th>
          <th class="border-b-2 p-4">Cantidad</th>
          <th class="border-b-2 p-4">Editar</th>
          <th class="border-b-2 p-4">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $conn = Conectarse();

        $stmt = $conn->prepare("SELECT cl, nombre, stock, sucursal_cs FROM Libros"); // Modificar la consulta para referenciar la columna correcta
        $stmt->execute();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($libros as $libro) {
          $valor_sucursal = $libro['sucursal_cs']; // Actualizar el nombre de la columna
          echo "<tr>";
          echo "<td class='border-b p-4'>" . $libro['cl'] . "</td>";
          echo "<td class='border-b p-4'>" . $libro['nombre'] . "</td>";
          echo "<td class='border-b p-4'>" . $libro['stock'] . "</td>";
          echo "<td class='border-b p-4'>
                <button class='bg-yellow-400 hover:bg-yellow-500 text-black py-2 px-4 rounded' onclick='fillEditModal(" . $libro['cl'] . ")' data-bs-toggle='modal' data-bs-target='#edicionLibroModal'>
                          EDITAR
                        </button>
                      </td>";
        
          echo "<td class='border-b p-4'>
                <button class='bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded' onclick='eliminarLibro(" . $libro['cl'] . ")'>
                    ELIMINAR
                    </button>
                </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Ventana Modal de Edición de Datos del Libro -->
<div class="modal fade" id="edicionLibroModal" tabindex="-1" aria-labelledby="edicionLibroModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="edicionLibroModalLabel">EDICIÓN DE DATOS DEL LIBRO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <div class="max-w-6xl mx-auto p-8 bg-white shadow-lg">
          <form id="editBookForm">
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="nombreLibro" class="form-label">Nombre del Libro</label>
                <input type="text" class="form-control" id="nombreLibro" name="nombreLibro" placeholder="Nombre del Libro" >
              </div>
              <div class="col-md-6">
                <label for="genero" class="form-label">Género</label>
                <input type="text" class="form-control" id="genero" name="genero" placeholder="Género">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
              </div>
              <div class="col-md-6">
                <label for="titulo" class="form-label">Título del Libro</label>
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título del Libro">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="editorial" class="form-label">Editorial</label>
                <input type="text" class="form-control" id="editorial" name="editorial" placeholder="Editorial">
              </div>
              <div class="col-md-6">
                <label for="anioPublicacion" class="form-label">Año de Publicación</label>
                <input type="number" class="form-control" id="anioPublicacion" name="anioPublicacion" placeholder="Año de Publicación">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
              </div>
            </div>

            <input type="hidden" id="cl" name="cl" value="">
            <input type="hidden" id="sucursal" name="sucursal" value="<?php echo $valor_sucursal; ?>">
          </form>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <button id="cancelarEdicionLibro" class="btn btn-danger me-md-2" type="button" data-bs-dismiss="modal">CANCELAR</button>
            <button id="guardarCambiosLibro" class="btn btn-success" type="button" onclick="guardarCambiosLibro()">GUARDAR CAMBIOS</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function eliminarLibro(cl) {
    if (confirm("¿Estás seguro de que deseas eliminar este libro?")) {
      fetch('../../../backend/models/Libro.php?cl=' + cl, {
        method: 'DELETE',
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('No se pudo eliminar el libro');
        }
        location.reload();
      })
      .catch(error => console.error('Error al eliminar el libro:', error));
    }
  }

  function fillEditModal(cl) {
    
  }

  function guardarCambiosLibro() {
    var cl = document.getElementById("cl").value;
    var nombre = document.getElementById("nombreLibro").value;
    var genero = document.getElementById("genero").value;
    var precio = document.getElementById("precio").value;
    var titulo = document.getElementById("titulo").value;
    var editorial = document.getElementById("editorial").value;
    var anioPublicacion = document.getElementById("anioPublicacion").value;
    var stock = document.getElementById("cantidad").value;
    var sucursal = document.getElementById("sucursal").value; 
    
    fetch('../../../backend/models/Libro.php', {
      method: 'POST',
      body: JSON.stringify({
        cl: cl,
        nombre: nombre,
        genero: genero,
        precio: precio,
        titulo: titulo,
        editorial: editorial,
        anioPublicacion: anioPublicacion,
        stock: stock,
        sucursal: sucursal 
      })
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('No se pudieron guardar los cambios');
      }
      location.reload();
    })
    .catch(error => console.error('Error al guardar los cambios:', error));
  }

  // Función para filtrar la tabla
  function filterTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("inventoryTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1]; 
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  document.getElementById("searchInput").addEventListener("input", filterTable);
</script>

<?php include '../templates/footer.php'; ?>
