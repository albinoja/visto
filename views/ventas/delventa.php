<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$idventa = $_POST['idventa'];
$sql = "DELETE FROM ventas WHERE idventa='$idventa' AND idusuario='$idusuario'";
$result = $conn->query($sql);
?>

<?php if ($result === TRUE): ?>
    <script>
        $(document).ready(function() {
            $("#sub-data").load("./views/ventas/principal.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php else: ?>
    <script>
        $(document).ready(function() {
            alert('Error al cerrar venta...');
            $("#sub-data").load("./views/ventas/principal.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php endif ?>