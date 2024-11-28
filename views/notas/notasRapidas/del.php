<?php
session_start();
include '../../../models/conexion.php';  // Asegúrate de que esta ruta es correcta
include '../../../controllers/controllersFunciones.php';
$conn = conectar_db();

// Verificar si se ha enviado el ID de la nota
if (isset($_POST['id'])) {
    $idnota = $_POST['id'];

    // Preparar la consulta de eliminación
    $sql = $conn->prepare("DELETE FROM notas WHERE id = ?");
    $sql->bind_param("i", $idnota);

    if ($sql->execute()) {
        // Si la eliminación es exitosa, puedes cargar las notas actualizadas o mostrar un mensaje
        echo '<script>
            alert("Nota eliminada correctamente...");
            $("#sub-data").load("./views/notas/notasRapidas/principal.php");
        </script>';
    } else {
        echo '<script>
            alert("Error al eliminar la nota...");
        </script>';
    }
} else {
    echo '<script>
        alert("ID de nota no encontrado...");
    </script>';
}

cerrar_db();
?>
