<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
    
    // Evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT DISTINCT cliente FROM ventas WHERE cliente LIKE ?");
    $nombre = "%" . $nombre . "%";
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $clientes = [];
    
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row['cliente']; // Agregar el cliente al array
    }
    
    echo json_encode($clientes); // Devolver los resultados como JSON
}

cerrar_db();
?>
