<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$idcategoria = $_POST['idcategoria'];
$categoria = $_POST['categoria'];

$estado = $_POST['estado'];
$tipo = $_POST['tipo'];
$sql = "UPDATE categorias SET categoria='$categoria', estado='$estado' WHERE idcategoria=$idcategoria";


$result = $conn->query($sql);

if ($result === TRUE) {
    echo '<script>
            $(document).ready(function() {
                $("#sub-data").load("./views/categorias/principal.php");
            });
        </script>';
    cerrar_db();
} else {
    echo '<script>
            $(document).ready(function() {
                alert(\'Error al actualizar usuario...\');
                $("#sub-data").load("./views/categorias/principal.php");
            });
        </script>';
    cerrar_db();
}
