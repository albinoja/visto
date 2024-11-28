<?php
session_start();
include '../../../models/conexion.php';
include '../../../controllers/controllersFunciones.php';
$conn = conectar_db();

// Verificar si se ha enviado el ID de la nota y la nueva nota
if (isset($_POST['idnota']) && isset($_POST['nota'])) {
    $idnota = $_POST['idnota'];
    $nota = $_POST['nota'];

    // Preparar la consulta para actualizar la nota
    $sql = $conn->prepare("UPDATE notas SET notas = ? WHERE id = ?");
    $sql->bind_param("si", $nota, $idnota);

    if ($sql->execute()) {
        // Si la actualización es exitosa, devolver un mensaje en formato JSON
        echo json_encode(["status" => "success", "message" => "Nota actualizada correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al actualizar la nota."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Error: Datos de la nota no recibidos."]);
}

cerrar_db();
?>
