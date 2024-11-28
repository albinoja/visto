<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$sql = "SELECT * FROM categorias";

$result = $conn->query($sql);
$cont = 0;
?>
<div>
    <p class="Panel PanelNotas"><b>Panel de notas</b></p>
</div>

<div class="container" id="sub-data" style="justify-content: center;">
        <div class="menu">
            <button id="Panel-NotasRapidas"  class="btn-menu btn-notas" data-color="#d1a30d">
                Notas <br><i class="fa-solid fa-cart-shopping"></i>
            </button>
            <button id="Panel-CuentasPorCobrar" class="btn-menu btn-CuentasPorCobrar"  data-color="#031A58">
                Cuentas por cobrar <br><i class="fa-solid fa-users"></i>
            </button>
</div>



<!-- Botones de notas y cuentas por cobrar -->

<script>

$(document).ready(function () {
      $("#Panel-NotasRapidas").click(function () {
        $("#sub-data").load("./views/notas/NotasRapidas/principal.php");
        return false;
      });
    });
</script>


<!-- Script no funciona, se deben de actualizar -->
<script>


   



    $(document).ready(function () {

    

        //
        $("#BtnNewCate").click(function () {
            $("#ModalPrincipal").modal("show");
            $('#DataEfectosModal').addClass('modal-dialog modal-dialog-centered modal-dialog-scrollable');
            document.getElementById("DataTituloModal").innerHTML = 'Registrar Categoría';
            $("#DataModalPrincipal").load("./views/categorias/form_insert.php");
            $('#ProcesoBotonModal').css('display', 'block');
            $('#ProcesoBotonModal2').css('display', 'none');
            document.getElementById("TituloBotonModal").innerHTML = 'Guardar';
            return false;
        });
        //
        $(".BtnUpdateCate").click(function () {
            let idcategoria = $(this).attr("idcategoria");
            $("#ModalPrincipal").modal("show");
            $('#DataEfectosModal').addClass('modal-dialog modal-dialog-centered modal-dialog-scrollable');
            document.getElementById("DataTituloModal").innerHTML = 'Modificar Categoría';
            $("#DataModalPrincipal").load("./views/categorias/form_update.php?idcategoria=" + idcategoria);
            $('#ProcesoBotonModal').css('display', 'none');
            $('#ProcesoBotonModal2').css('display', 'block');
            document.getElementById("TituloBotonModal2").innerHTML = 'Actualizar';
            return false;
        });
        // Proceso Insert
        $("#ProcesoBotonModal").click(function () {
            if ($('#categoria').val() === '' || $('#estado').val() === '' || $('#estado').val() == null) {
                alert('Por favor completa todos los campos.');
                return;
            }
            let categoria, estado;
            categoria = $('#categoria').val();
            estado = $('#estado').val();

            var formData = {
                categoria: categoria,
                estado: estado
            };
            $.ajax({
                type: 'POST',
                url: './views/categorias/insert.php',
                data: formData,
                dataType: 'html',
                success: function (response) {
                    $("#ModalPrincipal").modal("hide");
                    $('#categoria').val('');
                    $('#estado').val('');
                    $("#DataPanelCategorias").html(response);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return false;
        });
        // Proceso Update
        $("#ProcesoBotonModal2").click(function () {
            if ($('#categoria').val() === '' || $('#estado').val() === '' || $('#estado').val() == null) {
                alert('Por favor completa todos los campos.');
                return;
            }
            let idcategoria, categoria, estado;
            idcategoria = $('#idcategoria').val();
            categoria = $('#categoria').val();
            estado = $('#estado').val();

            var formData = {
                idcategoria: idcategoria,
                categoria: categoria,
                estado: estado
            };
            $.ajax({
                type: 'POST',
                url: './views/categorias/update.php',
                data: formData,
                dataType: 'html',
                success: function (response) {
                    $("#ModalPrincipal").modal("hide");
                    $('#categoria').val('');
                    $('#estado').val('');
                    $("#DataPanelCategorias").html(response);
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return false;
        });
        // Proceso Delete
        $('.BtnDeleteCate').click(function () {
            var respuesta = confirm('¿Desea eliminar la categoría?');
            let idcategoria = $(this).attr('idcategoria');

            if (respuesta) {
                $.ajax({
                    type: 'POST',
                    url: './views/categorias/del.php',
                    data: {
                        idcategoria: idcategoria
                    },
                    success: function (response) {
                        $("#DataPanelCategorias").html(response);
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