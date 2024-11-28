<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$idproducto = $_POST['idproducto'];
$producto = $_POST['producto'];
$detalle = $_POST['detalle'];
$stock = $_POST['stock'];
$estado = $_POST['estado'];
$pventa = $_POST['pventa'];
$pcompra = $_POST['pcompra'];
$minimo = $_POST['minimo'];
$imgFile = $_FILES['imagenProd']['name'];
$tmp_dir = $_FILES['imagenProd']['tmp_name'];
$imgSize = $_FILES['imagenProd']['size'];
$idproveedor = $_POST['idproveedor'];
$idcategoria = $_POST['idcategoria'];

if ($imgSize > 0) {
    $nombreArchivo = $idproducto;
    $dir = dirname(__FILE__) . "/imgproductos";
    $directorio = str_replace('\\', '/', $dir) . '/';
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $newName = $nombreArchivo . "." . $imgExt;

    $subir_archivo = $directorio . $newName;
    $img = $newName;

    if (!is_dir($directorio)) {
        mkdir($directorio, 0777, true);
    }

    if (copy($tmp_dir, $directorio . $newName)) {
        $subido = true;
    } else {
        $subido = false;
    }

    if ($subido === true) {
        $sql = "UPDATE productos SET producto='$producto', detalle='$detalle', stock='$stock', pventa='$pventa', pcompra='$pcompra', minimo='$minimo', idproveedor='$idproveedor', idcategoria='$idcategoria', estado='$estado'  WHERE idproducto='$idproducto'";

        // Ruta a la imagen que se actualizó
        $rutaImagen = $directorio . $newName;

        // Limpiar la caché de la imagen
        clearstatcache(true, $rutaImagen);

        $result = $conn->query($sql);

        if ($result === TRUE) {
            echo '<script>
            $(document).ready(function() {
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
            cerrar_db();
        } else {
            echo '<script>
            $(document).ready(function() {
                alert(\'Error al registrar producto...\');
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
            cerrar_db();
        }
    } else {
        echo '<script>
            $(document).ready(function() {
                alert(\'Error al cargar imagen de producto...\');
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
        cerrar_db();
    }
} else {
    $sql = "UPDATE productos SET producto='$producto', detalle='$detalle', stock='$stock', pventa='$pventa', pcompra='$pcompra', minimo='$minimo', idproveedor='$idproveedor', idcategoria='$idcategoria', estado='$estado'  WHERE idproducto='$idproducto'";

    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo '<script>
            $(document).ready(function() {
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
        cerrar_db();
    } else {
        echo '<script>
            $(document).ready(function() {
                alert(\'Error al registrar producto...\');
                $("#sub-data").load("./views/productos/principal.php");
            });
        </script>';
        cerrar_db();
    }
}
