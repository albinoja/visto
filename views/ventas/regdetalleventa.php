<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$idventa = $_POST['idventa'];
$idproducto = $_POST['idproducto'];
$cantidad = $_POST['cantidad'];
$pventa = $_POST['pventa'];
$total = $cantidad * $pventa;
$estado = 1;
$fecha = date("Y-m-d");
$sql = "INSERT INTO detalleventas(idventa, idproducto, cantidad, total, estado,fecha) VALUES('$idventa', '$idproducto', '$cantidad', '$total', '$estado', '$fecha')";

$result = $conn->query($sql);
?>

<?php if ($result === TRUE): ?>
    <?php
        $BuscadataProducto = "SELECT stock FROM productos WHERE idproducto='$idproducto'";
        $resultStock = $conn->query($BuscadataProducto);
        $row = $resultStock->fetch_assoc();
        $oldstock = $row['stock'];
        $nstock = $oldstock - $cantidad;
        $sqlUpdStock = "UPDATE productos SET stock='$nstock' WHERE idproducto='$idproducto'";
        $conn->query($sqlUpdStock);    
    ?>
    <script>
        $(document).ready(function() {
            $("#DataVentas").load("./views/ventas/preventa.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php else: ?>
    <script>
        $(document).ready(function() {
            alert('Error al agregar producto...');
            $("#sub-data").load("./views/ventas/principal.php");
        });
    </script>
    <?php cerrar_db(); ?>
<?php endif ?>