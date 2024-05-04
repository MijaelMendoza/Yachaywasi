<?php
session_start();

if ($_SESSION['isAdmin']) {
  include '../templates/header.php';
} else {
  include '../templates/header_Empleado.php';
}
require_once '../../../backend/core/Conexion.php';
$editoriales = obtenerEditoriales();
?>

<?php
function obtenerLibroPorId($conn, $id)
{
  $stmt = $conn->prepare("SELECT cl, genero, precio, titulo, anio_publicacion, stock FROM Libros WHERE cl = :id");
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

$conn = Conectarse();
?>

<div class="max-w-6xl mx-auto p-8">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">INVENTARIO</h1>
    <div class="relative">
      <input type="text" id="searchInput" class="border border-zinc-300 dark:border-zinc-700 p-3 rounded-md"
        placeholder="Search" oninput="filterTable()" />
    </div>
    <?php if ($_SESSION['isAdmin']): ?>
      <div class="mb-3 text-center">
        <form action="registrar_libro.php" method="post">
          <input type="hidden" name="sucursal" value="<?php echo htmlspecialchars($_SESSION['user_sucursal'] ?? ''); ?>">
          <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'] ?? ''); ?>">
          <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
            data-bs-target="#registroLibroModal">
            REGISTRAR LIBRO
          </button>
        </form>
      </div>
    <?php endif; ?>
  </div>
  <div class="overflow-x-auto">
    <table id="inventoryTable" class="w-full text-left border-collapse">
      <thead>
        <tr>
          <th class="border-b-2 p-4">ID</th>
          <th class="border-b-2 p-4">Titulo</th>
          <th class="border-b-2 p-4">Cantidad</th>
          <?php if ($_SESSION['isAdmin']): ?>
            <th class="border-b-2 p-4">Editar</th>
            <th class="border-b-2 p-4">Eliminar</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php
        $stmt = $conn->prepare("SELECT cl, titulo, stock, sucursal_cs, estado FROM Libros WHERE estado = true");
        $stmt->execute();
        $libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($libros as $libro) {
          echo "<tr>";
          echo "<td class='border-b p-4'>" . $libro['cl'] . "</td>";
          echo "<td class='border-b p-4'>" . $libro['titulo'] . "</td>";
          echo "<td class='border-b p-4'>" . $libro['stock'] . "</td>";
          if ($_SESSION['isAdmin']) {
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
          }
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


<!-- Ventana Modal de Edición de Datos del Libro -->
<div class="modal fade" id="edicionLibroModal" tabindex="-1" aria-labelledby="edicionLibroModalLabel"
  aria-hidden="true">
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
                <select class="form-control" id="editorial" name="editorial">
                  <?php foreach ($editoriales as $editorial): ?>
                    <option value="<?= $editorial['ce'] ?>"><?= htmlspecialchars($editorial['nombre']) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="anioPublicacion" class="form-label">Año de Publicación</label>
                <input type="number" class="form-control" id="anioPublicacion" name="anioPublicacion"
                  placeholder="Año de Publicación">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
              </div>
            </div>

            <input type="hidden" id="cl" name="cl" value="">
            <input type="hidden" id="sucursal" name="sucursal" value="">
          </form>
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
            <button id="cancelarEdicionLibro" class="btn btn-danger me-md-2" type="button"
              data-bs-dismiss="modal">CANCELAR</button>
            <button id="guardarCambiosLibro" class="btn btn-success" type="button"
              onclick="guardarCambiosLibro()">GUARDAR CAMBIOS</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include '../Registros/registrar_Libro.php' ?>
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
    fetch('../../../backend/models/Libro.php?cl=' + cl)
      .then(response => {
        if (!response.ok) {
          throw new Error('No se pudo obtener los datos del libro');
        }
        return response.json();
      })
      .then(libro => {
        if (Object.keys(libro).length === 0 && libro.constructor === Object) {
          throw new Error('No se recibieron datos del libro');
        }
        console.log(libro);
        document.getElementById("genero").value = libro.genero;
        document.getElementById("precio").value = libro.precio;
        document.getElementById("titulo").value = libro.titulo;
        document.getElementById("editorial").value = libro.editorial_ce;
        document.getElementById("anioPublicacion").value = libro.aniopublicacion;
        document.getElementById("cantidad").value = libro.stock;
        document.getElementById("cl").value = libro.cl;
        document.getElementById("sucursal").value = libro.sucursal_cs;
      })
      .catch(error => console.error('Error al obtener los datos del libro:', error));
  }

  function guardarCambiosLibro() {
    var cl = document.getElementById("cl").value;
    var genero = document.getElementById("genero").value;
    var precio = document.getElementById("precio").value;
    var titulo = document.getElementById("titulo").value;
    var editorial = document.getElementById("editorial").value;
    var anioPublicacion = document.getElementById("anioPublicacion").value;
    var stock = document.getElementById("cantidad").value;
    var sucursal = document.getElementById("sucursal").value;

    if (!cl || !genero || !precio || !titulo || !editorial || !anioPublicacion || !stock || !sucursal) {
      console.error('Todos los campos son obligatorios');
      return;
    }

    fetch('../../../backend/models/Libro.php', {
      method: 'POSTU',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        cl: cl,
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
        return response.json();
      })
      .then(data => {
        console.log(data.message);
        location.reload();
      })
      .catch(error => console.error('Error al guardar los cambios:', error));
  }


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