<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$idproducto = $_POST['idproducto'];
$sql = "DELETE FROM productos WHERE idproducto=$idproducto";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo '<script>
            $(document).ready(function() {
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
    cerrar_db();
} else {
    echo '<script>
            $(document).ready(function() {
                alert(\'Error al eliminar producto...\');
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
    cerrar_db();
}