<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$idventa = $_GET['idventa'];
$ventasEstado0 = "SELECT * FROM ventas WHERE idventa='$idventa'";
$result = $conn->query($ventasEstado0);
$row = $result->fetch_assoc();
$cliente = $row['cliente'];

$sql = "SELECT * FROM productos WHERE stock > 0 AND estado = 1";
$dataProductos = $conn->query($sql);

$sqlDV = "SELECT * FROM detalleventas WHERE idventa='$idventa' AND estado = 1";
$detallesVentas = $conn->query($sqlDV);

$contProd = 0;
$contProdDV = 0;
$contTproductos = 0;
$contTotalProductos = 0;
?>
<div id="muestra">
    <div style="text-align: center;">
        <img class="img-fluid rounded" src="./public/img/logo.png" width="100px" alt="Logo">
    </div>
    <b>Cliente: <?php echo $cliente; ?></b>
    <table class="table table-bordered table-hover table-borderless" style="margin: 0 auto; width: 90%; border-collapse: collapse;" border="1">
        <thead style="vertical-align: middle; text-align: center;">
            <tr>
                <th>N°</th>
                <th>Productos</th>
                <th>Precio <br>Unitario</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody style="vertical-align: middle; text-align: center;">
            <?php foreach ($detallesVentas as $data) : ?>
                <?php
                $idprod = $data['idproducto'];
                $dataProducto = "SELECT * FROM productos WHERE idproducto='$idprod'";
                $resultProd = $conn->query($dataProducto);
                $rowProd = $resultProd->fetch_assoc();
                $nproducto = $rowProd['producto'];
                $pventa = $rowProd['pventa'];
                ?>
                <tr>
                    <td><?php echo ++$contProdDV; ?></td>
                    <td><?php echo $nproducto; ?></td>
                    <td>$<?php echo number_format($pventa, 2); ?></td>
                    <td>
                        <?php
                        echo $data['cantidad'];
                        $contTproductos += $data['cantidad'];
                        ?>
                    </td>
                    <td>
                        $<?php
                            echo number_format($data['total'], 2);
                            $contTotalProductos += $data['total'];
                            ?>
                    </td>
                </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="3">Total</td>
                <td><?php echo $contTproductos; ?></td>
                <td>$<?php echo number_format($contTotalProductos, 2); ?></td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    function imprim2() {
        var carrera = "Comprobante de Venta";
        var mywindow = window.open('', 'PRINT', 'height=600,width=800');
        mywindow.document.write('<html><head><title>' + carrera + '</title>');
        mywindow.document.write(
            '<style>body{margin: 20mm 10mm 20mm 10mm; font-size:11px;font-family: "Roboto Condensed", sans-serif !important;} table {border-collapse: collapse;font-size:10px;}</style>'
        );
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById('muestra').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necesario para IE >= 10
        mywindow.focus(); // necesario para IE >= 10
        mywindow.print();
        mywindow.close();

        return true;
    }
</script>