<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$iddventa = $_POST['iddventa'];
$BuscadataDV = "SELECT * FROM detalleventas WHERE iddventa='$iddventa'";
$resultStock = $conn->query($BuscadataDV);
$rowDV = $resultStock->fetch_assoc();
$idproducto = $rowDV['idproducto'];
$cantidad = $rowDV['cantidad'];

$sql = "DELETE FROM detalleventas WHERE iddventa='$iddventa'";

$result = $conn->query($sql);
?>

<?php if ($result === TRUE) : ?>
    <?php
    $BuscadataProducto = "SELECT stock FROM productos WHERE idproducto='$idproducto'";
    $resultStock = $conn->query($BuscadataProducto);
    $row = $resultStock->fetch_assoc();
    $oldstock = $row['stock'];
    $nstock = $oldstock + $cantidad;
    $sqlUpdStock = "UPDATE productos SET stock='$nstock' WHERE idproducto='$idproducto'";
    $conn->query($sqlUpdStock);
    ?>
    <script>
        $(document).ready(function() {
            $("#DataVentas").load("./views/ventas/preventa.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php else : ?>
    <script>
        $(document).ready(function() {
            alert('Error al eliminar producto...');
            $("#sub-data").load("./views/ventas/preventa.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php endif ?>