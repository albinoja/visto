<?php
@session_start();


// para tener el id de 
if (isset($_SESSION['idbitacora'])) {
    $idbitacora = $_SESSION['idbitacora'];
} 

// ... (código para obtener el idbitacora)



if (isset($_POST['off'])) {


    // Conectar a la base de datos (reemplaza con tus datos)
    $conn = mysqli_connect("localhost", "root", "", "sciv");

    // Verificar conexión
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Establecer la zona horaria correcta
    date_default_timezone_set('America/El_Salvador'); 

    // Obtener la fecha y hora actual
    $fecha_fin = date("Y-m-d H:i:s");

    // Actualizar la bitácora
    $sql = "UPDATE bitacora_sesiones SET fecha_fin = '$fecha_fin', estado_sesion = 'Finalizado' WHERE idbitacora = $idbitacora";
    if (mysqli_query($conn, $sql)) {
        echo "Bitácora actualizada correctamente.";
    } else {
        echo "Error al actualizar la bitácora: " . mysqli_error($conn);
    }


    // cerrar sesion
    $_SESSION = [];
    session_destroy();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="./public/img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($_SESSION['LoginAccess'])): ?>
        <title>SVN</title>
    <?php else: ?>
        <title>Login</title>
    <?php endif ?>
    <!-- CSS -->
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./public/css/style.css">

    
    <script src="./public/js/jQuery3.7.1.js"></script>
    <script src="./public/js/jquery-1.9.1.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
    <script src="./public/js/fontawesome.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body id="dataRoot">


    <div class="container-fluid" id="data">
        <?php if (isset($_SESSION['LoginAccess'])): ?>
            <?php include './views/principal.php'; ?>
        <?php else: ?>
            <?php include './views/login.php'; ?>
        <?php endif ?>
    </div>
    <?php
    include './views/modal.php';
    include './views/modal_productos.php';
    ?>
</body>

</html>