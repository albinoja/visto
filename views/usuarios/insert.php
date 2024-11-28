<?php
session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$usuario = $_POST['usuario'];
$empleado = $_POST['empleado'];
$clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$estado = $_POST['estado'];
$tipo = $_POST['tipo'];

// Verificar si el usuario ya existe en la base de datos
$sql_check = "SELECT COUNT(*) AS count FROM usuarios WHERE usuario = '$usuario'";
$result_check = $conn->query($sql_check);
$row = $result_check->fetch_assoc();

if ($row['count'] > 0) {
    // El usuario ya existe, mostrar mensaje de error
    echo '<script>
        $(document).ready(function() {
            $("#sub-data").load("./views/usuarios/principal.php");
        });
    </script>';
} else {
    // El usuario no existe, proceder con la inserción
    $sql_insert = "INSERT INTO usuarios(usuario, empleado, clave, estado, tipo) 
                   VALUES('$usuario', '$empleado', '$clave', '$estado', '$tipo')";
    $result_insert = $conn->query($sql_insert);

    if ($result_insert === TRUE) {
        echo '<script>
            $(document).ready(function() {
                alert(\'Usuario registrado...\');
                $("#sub-data").load("./views/usuarios/principal.php");
            });
        </script>';
    } else {
        echo '<script>
            $(document).ready(function() {
                alert(\'Error al registrar usuario...\');
                $("#sub-data").load("./views/usuarios/principal.php");
            });
        </script>';
    }
}

cerrar_db();
?>
