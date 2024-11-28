<?php
session_start();
include '../../../models/conexion.php';
include '../../../controllers/controllersFunciones.php';
$conn = conectar_db();

// Capturar la nota enviada por el formulario de forma segura
$notas = $_POST['note'];

// Verificar si la nota está vacía
if (empty(trim($notas))) {
    echo '<script>
        alert("La nota no puede estar vacía...");
        $("#sub-data").load("./views/notas/notasRapidas/principal.php");
    </script>';
} else {
    // La nota no está vacía, proceder con la inserción
    $sql = $conn->prepare("INSERT INTO notas (notas) VALUES (?)");
    $sql->bind_param("s", $notas);

    if ($sql->execute()) {
        // Mensaje en caso de éxito
        echo '<script>
            alert("Nota registrada correctamente...");
            $("#sub-data").load("./views/notas/notasRapidas/principal.php");
        </script>';
    } else {
        // Mensaje en caso de error
        echo '<script>
            alert("Error al registrar nota...");
            $("#sub-data").load("./views/notas/notasRapidas/principal.php");
        </script>';
    }
}

// Cerrar la conexión a la base de datos
cerrar_db();
?>
