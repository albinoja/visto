<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$sqlMaxid = "SELECT MAX(idventa) AS idventa FROM ventas";

$resultMaxId = $conn->query($sqlMaxid);
$rowMaxId = $resultMaxId->fetch_assoc();
$idventa = $rowMaxId['idventa'] + 1;
$cliente = $_POST['cliente'];
$idusuario = $_SESSION['idusuario'];
$fecha = date("Y-m-d H:i:s");
$estado = 0;
$sql = "INSERT INTO ventas(idventa, cliente, idusuario, fecha, estado) VALUES('$idventa', '$cliente', '$idusuario', '$fecha', '$estado')";

$result = $conn->query($sql);
?>

<?php if ($result === TRUE): ?>
    <script>
        $(document).ready(function() {
            $("#DataVentas").load("./views/ventas/preventa.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php else: ?>
    <script>
        $(document).ready(function() {
            alert('Error al registrar venta...');
            $("#sub-data").load("./views/ventas/principal.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php endif ?>
