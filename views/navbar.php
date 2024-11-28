<?php
// Asumiendo que ya tienes una conexión a la base de datos establecida ($conn)
$sql = "SELECT * FROM productos WHERE stock <= minimo AND estado = 1";
$result = $conn->query($sql);
$notificationCount = $result->num_rows;

// Obtener los detalles de los productos con stock bajo
$lowStockProducts = [];
if ($notificationCount > 0) {
    while ($row = $result->fetch_assoc()) {
        $lowStockProducts[] = $row;
    }
}
?>


<nav id="navbar" class="navbar navbar-expand-lg navbar-light" style="background-color: #6B8E23;">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="./index.php">SVN</a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon bg-light"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#6B8E23" href="./index.php"
            onclick="window.location.reload(); return false;">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#d1a30d" href="./views/ventas/principal.php">Ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#031A58" href="./views/usuarios/principal.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#9370DB"
            href="./views/proveedores/principal.php">Proveedores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#CD5C5C"
            href="./views/productos/principal.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#66B2B2"
            href="./views/categorias/principal.php">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#3399FF" href="./views/notas/principal.php">Notas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" data-color="#FF6600" href="./views/backup/principal.php">Backup</a>
        </li>
      </ul>

      <button id="notificationBtn" class="btn btn-secondary btn-sm text-white" style="margin-right:10px;">
                <i class="fa-solid fa-bell"></i>
                <?php if ($notificationCount > 0): ?>
                    <span class="notification-badge"><?php echo $notificationCount; ?></span>
                <?php endif; ?>
            </button>


      <form action="./index.php" class="d-flex" method="POST">
        <input type="hidden" value="1" name="off">
        <button class="btn btn-danger btn-sm text-white">
          <i class="fa-solid fa-right-from-bracket"></i>
        </button>
      </form>
    </div>
  </div>
</nav>



<!-- Modal de Notificaciones -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notificaciones de Stock Bajo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if ($notificationCount > 0): ?>
                    <ul class="list-group">
                        <?php foreach ($lowStockProducts as $product): ?>
                            <li class="list-group-item">
                                Producto: <?php echo htmlspecialchars($product['producto']); ?><br>
                                Stock Actual: <?php echo htmlspecialchars($product['stock']); ?><br>
                                Stock Mínimo: <?php echo htmlspecialchars($product['minimo']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No hay productos con stock bajo en este momento.</p>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


<script>
$(document).ready(function() {
    $('#notificationBtn').click(function() {
        $('#notificationModal').modal('show');
    });
});
</script>

<script>
  $(document).ready(function () {
    // Manejar clics en los enlaces de la barra de navegación
    $("#nav-ventas").click(function () {
      $("#sub-data").load("./views/ventas/principal.php");
      return false; // Evita el comportamiento por defecto del enlace
    });

    $("#nav-usuarios").click(function () {
      $("#sub-data").load("./views/usuarios/principal.php");
      return false;
    });

    $("#nav-proveedores").click(function () {
      $("#sub-data").load("./views/proveedores/principal.php");
      return false;
    });

    $("#nav-productos").click(function () {
      $("#sub-data").load("./views/productos/principal.php");
      return false;
    });

    $("#nav-categorias").click(function () {
      $("#sub-data").load("./views/categorias/principal.php");
      return false;
    });

    $("#nav-notas").click(function () {
      $("#sub-data").load("./views/notas/principal.php");
      return false;
    });

    $("#nav-backup").click(function () {
      $("#sub-data").load("./views/backup/principal.php");
      return false;
    });
  });
</script>