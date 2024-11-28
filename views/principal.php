<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include './models/conexion.php';
include './controllers/controllersFunciones.php';
$conn = conectar_db();
$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];

/* Consulta para obtener productos con stock bajo */
$sql = "SELECT * FROM productos WHERE stock <= minimo AND estado = 1";
$result = $conn->query($sql);
?>




<?php if (isset($_SESSION['LoginAccess'])): ?>
  <?php include './views/navbar.php'; ?>
<?php endif ?>


<div class="card card-principal">

  <div class="card-body" id="sub-data">

    <?php
    /* Muestra una alerta si hay productos con stock bajo */
    if ($result->num_rows > 0) {
      echo '<div class="alert alert-warning alerta-stockMinimo">';
      echo "<b>¡Alerta! Tienes productos con stock bajo</b><br>";
      // while ($row = $result->fetch_assoc()) {
      //   echo "Producto: " . htmlspecialchars($row["producto"]) . " | Stock: " . htmlspecialchars($row["stock"]) . " | Stock Mínimo: " . htmlspecialchars($row["minimo"]) . "<br>";
      // }
      echo '</div>';
    }

    $conn->close();
    ?>

    <div class="container" id="sub-data">
      <div class="menu">
        <button id="Panel-Ventas" class="btn-menu btn-ventas" data-color="#d1a30d">
          Ventas <br><i class="fa-solid fa-cart-shopping"></i>
        </button>
        <button id="Panel-Usuarios" class="btn-menu btn-usuarios" data-color="#031A58">
          Usuarios <br><i class="fa-solid fa-users"></i>
        </button>
        <button id="Panel-Proveedores" class="btn-menu btn-proveedores" data-color="#9370DB">
          Proveedores <br><i class="fa-solid fa-truck-fast"></i>
        </button>
        <button id="Panel-Productos" class="btn-menu btn-productos" data-color="#CD5C5C">
          Productos <br><i class="fa-solid fa-cookie-bite"></i>
        </button>
        <button id="Panel-Categorias" class="btn-menu btn-categorias" data-color="#66B2B2">
          Categorías <br><i class="fa-solid fa-table"></i>
        </button>


        <button id="Panel-Reportes" class="btn-menu btn-reportes text-white" data-color="#FF9800">
          Reportes <br><i class="fa-solid fa-file-alt"></i>
        </button>
        <button id="Panel-Notas" class="btn-menu btn-notas text-white" data-color="#3399FF">
          Notas <br><i class="fa-regular fa-note-sticky"></i>
        </button>
        <button id="Panel-Backup" class="btn-menu btn-backup text-white" data-color="#FF6600">
          Backup <br><i class="fa-solid fa-file-export"></i>
        </button>
        <button id="Panel-Ayuda" class="btn-menu btn-backup text-white" data-color="#FF6600">
          Ayuda <br><i class="fa-solid fa-file-export"></i>
        </button>
        <button id="Panel-Salir" class="btn-menu btn-salir text-white" data-color="#DC3545">
          Salir <br><i class="fa-solid fa-right-from-bracket"></i>
        </button>
      </div>

    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $("#Panel-Ventas").click(function () {
        $("#sub-data").load("./views/ventas/principal.php");
        return false;
      });

      $("#Panel-Usuarios").click(function () {
        $("#sub-data").load("./views/usuarios/principal.php");
        return false;
      });

      $("#Panel-Proveedores").click(function () {
        $("#sub-data").load("./views/proveedores/principal.php");
        return false;
      });

      $("#Panel-Productos").click(function () {
        $("#sub-data").load("./views/productos/principal.php");
        return false;
      });

      $("#Panel-Categorias").click(function () {
        $("#sub-data").load("./views/categorias/principal.php");
        return false;
      });

      $("#Panel-Reportes").click(function () {
        $("#sub-data").load("./views/reportes/principal.php");
        return false;
      });

      $("#Panel-Ayuda").click(function () {
        $("#sub-data").load("./views/ayuda/principal.php");
        return false;
      });

      $("#Panel-Salir").click(function () {
        // Aquí puedes agregar la lógica para cerrar sesión
        alert("Cerrando sesión...");
        // redirigir o realizar otra acción
      });

      $(".btn-menu").click(function () {
        // Obtener el color del botón clicado
        const color = $(this).data("color");

        // Cambiar el color de fondo del nav
        $("#navbar").css("background-color", color);

        // Cargar el contenido correspondiente
        const target = $(this).attr('id').replace('Panel-', '').toLowerCase();
        $("#sub-data").load(`./views/${target}/principal.php`);

        return false;
      });

      // Agregar la funcionalidad a los enlaces del navbar
      $(".nav-link").click(function () {
        // Obtener el color del botón correspondiente
        const color = $(this).data("color");

        // Cambiar el color de fondo del nav
        $("#navbar").css("background-color", color);

        // Cargar el contenido correspondiente
        const target = $(this).text().toLowerCase();
        $("#sub-data").load(`./views/${target}/principal.php`);

        return false;
      });
    });
  </script>