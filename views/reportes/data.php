<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$fi = $_POST['fi'];
$ff = $_POST['ff'];

$BuscaVentas = "SELECT * FROM detalleventas AS dv 
INNER JOIN ventas as v ON v.idventa=dv.idventa 
INNER JOIN productos AS p ON p.idproducto=dv.idproducto 
INNER JOIN usuarios AS u ON u.idusuario=v.idusuario 
WHERE dv.fecha BETWEEN '$fi' AND '$ff'";
$resultVentas = $conn->query($BuscaVentas);

$cont = 0;
$contTproductos = 0;
$contTotalProductos = 0;
?>
<style>
    @media print {.ocultar-en-impresion {display: none;}}
</style>
<?php if ($resultVentas && $resultVentas->num_rows > 0) : ?>
    <div id="muestraReportesVentas">
        <div style="text-align: center;">
            <img class="img-fluid rounded" src="./public/img/logo.png" width="80px" alt="Logo">
        </div>
        <p style="text-align: center;"><b>Reporte General de ventas <?php echo $fi; ?> a <?php echo $ff; ?></b></p>
        <hr>
        <table class="table table-bordered table-hover table-borderless" style="margin: 0 auto; width: 100%; border-collapse: collapse;" border="1">
            <thead style="vertical-align: middle; text-align: center;">
                <tr>
                    <th>N°</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Productos</th>
                    <th>Precio <br>Unitario</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th class="ocultar-en-impresion"><i class="fa-solid fa-receipt"></i></th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle; text-align: center;">
                <?php foreach ($resultVentas as $result) : ?>
                    <tr>
                        <td><?php echo ++$cont; ?></td>
                        <td><?php echo $result['cliente']; ?></td>
                        <td><?php echo $result['empleado']; ?></td>
                        <td><?php echo $result['producto']; ?></td>
                        <td>$<?php echo  number_format($result['pventa'], 2); ?></td>
                        <td>
                            <?php
                            echo $result['cantidad'];
                            $contTproductos += $result['cantidad'];
                            ?>
                        </td>
                        <td>
                            $<?php
                                echo number_format(($result['cantidad'] * $result['pventa']), 2);
                                $contTotalProductos += ($result['cantidad'] * $result['pventa']);
                                ?>
                        </td>
                        <td class="ocultar-en-impresion">
                            <a href="" class="btn text-white BtnComprobanteVenta" idventa="<?php echo $result['idventa']; ?>" style="background-color: #031A58;"><i class="fa-solid fa-receipt"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="5">Total</td>
                    <td><?php echo $contTproductos; ?></td>
                    <td>$<?php echo number_format($contTotalProductos, 2); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="button" style="margin-top: 10px;" class="btn btn-primary" onclick="javascript:imprimReporteVentas();"><i class="fa-solid fa-print"></i></button>
<?php else : ?><div class="alert alert-danger">
        <b>No se encuentran registro de ventas en las fechas seleccionadas........</b>
    </div>
<?php endif ?>
<script>
    $(document).ready(function() {
        $(".BtnComprobanteVenta").click(function() {
            let idventa = $(this).attr('idventa');
            $("#ModalPrincipal2").modal("show");
            $('#DataEfectosModal2').addClass('modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl');
            document.getElementById("DataTituloModal2").innerHTML = 'Comprobante de Venta';
            $("#DataModalPrincipal2").load("./views/ventas/comprobante.php?idventa=" + idventa);
            return false;
        });

    });

    function imprimReporteVentas() {
        var carrera = "Comprobante de Venta";
        var mywindow = window.open('', 'PRINT', 'height=600,width=800');
        mywindow.document.write('<html><head><title>' + carrera + '</title>');
        mywindow.document.write(
            '<style>body{margin: 20mm 10mm 20mm 10mm; font-size:11px;font-family: "Roboto Condensed", sans-serif !important;} table {border-collapse: collapse;font-size:12px;} @media print {.ocultar-en-impresion {display: none;}}</style>'
        );
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById('muestraReportesVentas').innerHTML);
        mywindow.document.write('</body></html>');
        mywindow.document.close(); // necesario para IE >= 10
        mywindow.focus(); // necesario para IE >= 10
        mywindow.print();
        mywindow.close();

        return true;
    }
</script>