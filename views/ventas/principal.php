<?php
@session_start();
date_default_timezone_set('America/El_Salvador');
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();
$idusuario = $_SESSION['idusuario'];
$ventasEstado0 = "SELECT COUNT(*) AS tventas FROM ventas WHERE estado=0 AND idusuario='$idusuario'";
$result = $conn->query($ventasEstado0);
$row = $result->fetch_assoc();
$tventas = $row['tventas'];
?>
<style>
    .bloqueado {
        pointer-events: none;
        opacity: 0.5;
        /* Puedes ajustar la opacidad para hacer el botón más transparente si lo deseas */
        cursor: not-allowed;
        /* Cambia el cursor para indicar que el botón no está disponible */
    }
</style>
<div>
    <p class="Panel PanelVentas" ><b>Panel Ventas</b></p>
</div>
<div class="row">
    <div class="col-md-3" style="margin-bottom: 5px;">
        <div class="card">
            <div class="card-header">
                <b>Registra Venta</b>
                <?php if ($tventas == 0) : ?>
                    <a href="" style="float: right;" class="btn btn-warning bloqueado" disabled><i class="fa-solid fa-cart-shopping"></i> <?php echo $tventas; ?></a>
                <?php else : ?>
                    <a href="" style="float: right;" class="btn btn-warning" id="BtnPreventa"><i class="fa-solid fa-cart-shopping"></i> <?php echo $tventas; ?></a>
                <?php endif ?>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <span class="input-group-text"><b>Cliente:</b></span>
                    <textarea class="form-control" name="cliente" id="cliente"></textarea>
                </div>
                <ul id="sugerencias" class="list-group" style="display: none;"></ul>
                <a class="btn btn-primary" id="BtnReg-Venta"><b>Procesar</b></a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <b>Resultado</b>
            </div>
            <div class="card-body" id="DataVentas">
                <?php if (isset($_GET['idventa'])) : ?>
                    <script>
                        $(document).ready(function() {
                            let idventa = '<?php echo $_GET['idventa'];?>';
                            $("#ModalPrincipal2").modal("show");
                            $('#DataEfectosModal2').addClass('modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl');
                            document.getElementById("DataTituloModal2").innerHTML = 'Comprobante de Venta';
                            $("#DataModalPrincipal2").load("./views/ventas/comprobante.php?idventa=" + idventa);
                            return false;
                        });
                    </script>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<script>
    // busqueda del cliente en la base de datos cliente
    $(document).ready(function () {
    $('#cliente').on('input', function () {
        let nombreCliente = $(this).val();

        if (nombreCliente.length > 0) {
            $.ajax({
                type: 'POST',
                url: './views/ventas/busquedaCliente.php', // Ruta del archivo PHP que maneja la búsqueda
                data: { nombre: nombreCliente },
                dataType: 'json',
                success: function (response) {
                    $('#sugerencias').empty(); // Limpiar sugerencias anteriores

                    if (response.length > 0) {
                        $.each(response, function (index, cliente) {
                            $('#sugerencias').append('<li class="list-group-item cliente-sugerido">' + cliente + '</li>');
                        });
                        $('#sugerencias').show(); // Mostrar la lista de sugerencias
                    } else {
                        $('#sugerencias').hide(); // Ocultar si no hay sugerencias
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la búsqueda:', error);
                }
            });
        } else {
            $('#sugerencias').hide(); // Ocultar sugerencias si no hay texto
        }
    });

    // Agregar un evento de clic en las sugerencias
    $(document).on('click', '.cliente-sugerido', function () {
        $('#cliente').val($(this).text()); // Colocar el nombre del cliente en el textarea
        $('#sugerencias').hide(); // Ocultar las sugerencias
    });
});






    $(document).ready(function() {
        $("#BtnReg-Venta").click(function() {
            if ($('#cliente').val() === '') {
                alert('Por favor ingrese datos del cliente....');
                return;
            }
            let cliente;
            cliente = $('#cliente').val();

            var formData = {
                cliente: cliente
            };
            $.ajax({
                type: 'POST',
                url: './views/ventas/regventa.php',
                data: formData,
                dataType: 'html',
                success: function(response) {
                    $('#cliente').val('');
                    $("#DataVentas").html(response);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return false;
        });

        $("#BtnPreventa").click(function() {
            $("#DataVentas").load("./views/ventas/preventa.php");
            return false;
        });
    });
</script>