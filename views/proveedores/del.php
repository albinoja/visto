<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$idproveedor = $_POST['idproveedor'];
$sql = "DELETE FROM proveedores WHERE idproveedor=$idproveedor";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo '<script>
            $(document).ready(function() {
                $("#sub-data").load("./views/proveedores/principal.php");
            });
        </script>';
    cerrar_db();
} else {
    echo '<script>
            $(document).ready(function() {
                alert(\'Error al eliminar proveedor...\');
                $("#sub-data").load("./views/proveedores/principal.php");
            });
        </script>';
    cerrar_db();
}