<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$idusuario = $_POST['idusuario'];
$sql = "DELETE FROM usuarios WHERE idusuario=$idusuario";
$result = $conn->query($sql);

if ($result === TRUE) {
    echo '<script>
            $(document).ready(function() {
                $("#sub-data").load("./views/usuarios/principal.php");
            });
        </script>';
    cerrar_db();
} else {
    echo '<script>
            $(document).ready(function() {
                alert(\'Error al eliminar usuario...\');
                $("#sub-data").load("./views/usuarios/principal.php");
            });
        </script>';
    cerrar_db();
}