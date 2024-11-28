<?php
session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$categoria = $_POST['categoria'];
$estado = $_POST['estado'];

// Verificar si la categoría ya existe en la base de datos
$sql_check = "SELECT COUNT(*) AS count FROM categorias WHERE categoria = '$categoria'";
$result_check = $conn->query($sql_check);
$row = $result_check->fetch_assoc();

if ($row['count'] > 0) {
    // La categoría ya existe, mostrar mensaje de error
    echo '<script>
        $(document).ready(function() {
            $("#sub-data").load("./views/categorias/principal.php");
        });
    </script>';
} else {
    // La categoría no existe, proceder con la inserción
    $sql = "INSERT INTO categorias(categoria, estado) VALUES('$categoria', '$estado')";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo '<script>
            $(document).ready(function() {
                alert(\'Categoría registrada correctamente...\');
                $("#sub-data").load("./views/categorias/principal.php");
            });
        </script>';
    } else {
        echo '<script>
            $(document).ready(function() {
                alert(\'Error al registrar categoría...\');
                $("#sub-data").load("./views/categorias/principal.php");
            });
        </script>';
    }
}

cerrar_db();
?>
