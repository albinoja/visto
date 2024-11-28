<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include './models/conexion.php';
include './controllers/controllersFunciones.php';
$conn = conectar_db();
$result = $_GET['data'];
/* Este código PHP genera un mensaje de alerta y enumera productos con stock bajo. Aquí hay un desglose
de lo que hace: */
echo "<b>¡Alerta! Los siguientes productos tienen un stock bajo:</b><br>";
while ($row = $result->fetch_assoc()) {
  echo "Producto: " . $row["producto"] . " - Stock: " . $row["stock"] . "<br>";
}
$conn->close();
