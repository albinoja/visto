<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$idventa = $_POST['idventa'];
$sql = "UPDATE ventas SET estado=1 WHERE idventa='$idventa'";
$result = $conn->query($sql);
?>

<?php if ($result === TRUE): ?>
    <script>
        $(document).ready(function() {
            let idventa = '<?php echo $idventa;?>';
            $("#sub-data").load("./views/ventas/principal.php?idventa=" + idventa);
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