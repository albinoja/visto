<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$ventasEstado0 = "SELECT * FROM ventas WHERE estado=0 AND idusuario='$idusuario'";
$result = $conn->query($ventasEstado0);
$row = $result->fetch_assoc();
$idventa = $row['idventa'];
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
<div>
    <p style="text-align: center;"><b>Agregar Productos a Venta</b></p>
    <hr>
    <i class="fa-solid fa-clipboard-check"></i> : <b>Cerrar Venta</b> | <i class="fa-solid fa-eraser"></i> : <b>Eliminar
        Venta</b>
    <hr>
    <b>Cliente: <?php echo $cliente; ?></b>
    <?php if ($detallesVentas && $detallesVentas->num_rows > 0): ?>
        <hr>
        <table class="table table-bordered table-hover table-borderless tablaPreVenta">
            <thead>
                <tr>
                    <th class="thVentas">N°</th>
                    <th class="thVentas">Productos</th>
                    <th class="thVentas">Precio <br>Unitario</th>
                    <th class="thVentas">Cantidad</th>
                    <th class="thVentas">Total</th>
                    <th class="thVentas"><i class="fa-solid fa-trash-can"></i></th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle; text-align: center;">
                <?php foreach ($detallesVentas as $data): ?>
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
                        <td>
                            <a href="" class="btn text-white BtnDelProductoCarrito" iddventa="<?php echo $data['iddventa']; ?>"
                                class="fa-solid fa-trash-can"></i>Eliminar</a>
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
        <a href="" class="btn BtnCerrarVenta" style="background-color: #6B8E23;color:white;margin-top: 10px;"
            idventa="<?php echo $data['idventa']; ?>"><b><i class="fa-solid fa-clipboard-check"></i>Cerrar Venta</b></a>
    <?php else: ?>
        <br>
        <a href="" class="btn BtnEliminarVenta" style="background-color: #B22222;color:white;margin-top: 10px;"
            idventa="<?php echo $idventa; ?>"><b><i class="fa-solid fa-eraser"></i> Eliminar Venta</b></a>
        <div class="alert alert-danger">
            <b>No se encuentran productos agregados al carrito........</b>
        </div>
    <?php endif ?>
</div>
<hr>
<p style="text-align: center;"><b>Inventario</b></p>
<hr>
<div>
    <?php if ($dataProductos && $dataProductos->num_rows > 0): ?>
        <table class="table table-bordered table-hover table-borderless tablaPreVenta" style="margin: 0 auto; width: 100%">
            <thead>
                <tr>
                    <th class="thVentas">N°</th>
                    <th class="thVentas">Producto</th>
                    <th class="thVentas">Descripción</th>
                    <th class="thVentas">Stock</th>
                    <th class="thVentas">Precio <br>Venta</th>
                    <th class="thVentas">Cantidad</th>
                    <th class="thVentas"><i class="fa-solid fa-cart-plus"></i></th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle; text-align: center;">
                <?php foreach ($dataProductos as $data): ?>
                    <tr>
                        <td><?php echo ++$contProd; ?></td>
                        <td><?php echo $data['producto']; ?></td>
                        <td>
                            <img src="./views/productos/imgproductos/<?php echo $data['img']; ?>" width="80px" alt="">
                        </td>
                        <td><?php echo $data['stock']; ?></td>
                        <td>
                            $<?php echo $data['pventa']; ?>
                        </td>
                        <td>
                            <input type="number" class="form-control" style="width: 80px;" name="cantidad"
                                id="cantidad-<?php echo $data['idproducto']; ?>" value="0" min="0">
                        </td>
                        <td>
                            <a href="" class="btn text-white BtnAddProducto" idproducto="<?php echo $data['idproducto']; ?>"
                                idventa="<?php echo $idventa; ?>" pventa="<?php echo $data['pventa']; ?>"
                                style="background-color: #031A58;"><i class="fa-solid fa-cart-plus"></i>Agregar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-danger">
            <b>No se encuentran productos........</b>
        </div>
    <?php endif ?>
    <?php cerrar_db(); ?>
</div>
<script>
    $(document).ready(function () {
        // Proceso ADD PRODUCT
        $('.BtnAddProducto').click(function () {
            var respuesta = confirm('¿Desea agregar producto a carrito....?');
            let idproducto = $(this).attr('idproducto');
            let cantidad = $("#cantidad-" + idproducto).val();
            let pventa = $(this).attr('pventa');
            let idventa = $(this).attr('idventa');
            if (respuesta) {
                if (cantidad == 0 || cantidad == null) {
                    alert("Favor de seleccionar la cantidad de producto a vender");
                } else {
                    $.ajax({
                        type: 'POST',
                        url: './views/ventas/regdetalleventa.php',
                        data: {
                            idproducto: idproducto,
                            cantidad: cantidad,
                            pventa: pventa,
                            idventa: idventa
                        },
                        success: function (response) {
                            $("#DataVentas").html(response);
                        },
                        error: function (xhr, status, error) {
                            alert(xhr.responseText);
                        }
                    });
                }

            } else {
                // Si el usuario elige cancelar, no hacer nada
                alert('Proceso cancelado');
            }
            return false;
        });

        // Proceso DEL PRODUCT
        $('.BtnDelProductoCarrito').click(function () {
            var respuesta = confirm('¿Desea eliminar producto de carrito....?');
            let iddventa = $(this).attr('iddventa');

            if (respuesta) {
                $.ajax({
                    type: 'POST',
                    url: './views/ventas/delcarrito.php',
                    data: {
                        iddventa: iddventa
                    },
                    success: function (response) {
                        $("#DataVentas").html(response);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            } else {
                // Si el usuario elige cancelar, no hacer nada
                alert('Proceso cancelado');
            }
            return false;
        });

        // Proceso Cerrar Venta
        $('.BtnCerrarVenta').click(function () {
            var respuesta = confirm('¿Desea cerrar la venta....?');
            let idventa = $(this).attr('idventa');

            if (respuesta) {
                $.ajax({
                    type: 'POST',
                    url: './views/ventas/cerrar.php',
                    data: {
                        idventa: idventa
                    },
                    success: function (response) {
                        $("#DataVentas").html(response);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            } else {
                // Si el usuario elige cancelar, no hacer nada
                alert('Proceso cancelado');
            }
            return false;
        });

        // Proceso Eliminar Venta
        $('.BtnEliminarVenta').click(function () {
            var respuesta = confirm('¿Desea eliminar la venta....?');
            let idventa = $(this).attr('idventa');

            if (respuesta) {
                $.ajax({
                    type: 'POST',
                    url: './views/ventas/delventa.php',
                    data: {
                        idventa: idventa
                    },
                    success: function (response) {
                        $("#DataVentas").html(response);
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            } else {
                // Si el usuario elige cancelar, no hacer nada
                alert('Proceso cancelado');
            }
            return false;
        });
    });
</script>