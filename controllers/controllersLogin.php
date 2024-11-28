<?php
@session_start();
include '../models/conexion.php';
include './controllersFunciones.php';
$conn = conectar_db();

if (isset($_POST['BtnLogin'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        /* Esta parte del código recupera los datos del conjunto de resultados de la base de datos
        después de ejecutar la consulta SQL. A continuación se muestra un desglose de lo que hace
        cada línea: */
        $row = $result->fetch_assoc();
        $idusuario = $row['idusuario'];
        $hash = $row['clave'];
        $estado = $row['estado'];
        $tipo = $row['tipo'];

        if($estado == 1){
           /* Esta parte del código es responsable de verificar la contraseña ingresada por el usuario
           durante el proceso de inicio de sesión. Aquí hay un desglose de lo que hace: */
            if(password_verify($clave,$hash)){
                /* Las líneas `['LoginAccess'] = 1;`, `['idusuario'] = ;`,
                `['usuario'] = ;`, y `['tipo '] = ;` están
                configurando variables de sesión en PHP. Esto es lo que hace cada una de estas
                líneas: */
                $_SESSION['LoginAccess'] = 1;
                $_SESSION['idusuario'] = $idusuario;
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo'] = $tipo;



                // Establecer la zona horaria correcta
            date_default_timezone_set('America/El_Salvador');
        
            // Obtener la fecha y hora actual
            $fecha_inicio = date("Y-m-d H:i:s");
        
            // Insertar registro en la tabla de bitácora
            $sql = "INSERT INTO bitacora_sesiones (idusuario, fecha_inicio, estado_sesion) 
                    VALUES ('$idusuario', '$fecha_inicio', 'Iniciado')";
            $resultado = mysqli_query($conn, $sql);
        
            if ($resultado) {
                // Obtener el ID del último registro insertado
            $idbitacora = mysqli_insert_id($conn);

            // Almacenar el ID de bitácora en la sesión (opcional)
            $_SESSION['idbitacora'] = $idbitacora;

            
                // Redirigir al usuario
                header("Location: ../index.php");
            } else {
                // Manejar el error de inserción en la bitácora
                echo "Error al registrar el inicio de sesión";
            }
            
            }else{
                echo '<script>
                    var msj = "Contraseña incorrecta...";
                    alert(msj);
                    setTimeout(function(){
                        window.location.href = "../index.php";
                    },1000);
                </script>';
            }
        }else{
            echo '<script>
                var msj = "El usuario sin permisos de acceso...";
                alert(msj);
                setTimeout(function(){
                    window.location.href = "../index.php";
                },1000);
            </script>';
        }
    } else {
        echo '<script>
                var msj = "El usuario no existe...";
                alert(msj);
                setTimeout(function(){
                    window.location.href = "../index.php";
                },1000);
            </script>';
    }
} else {
    header("Location: ../index.php");
}
