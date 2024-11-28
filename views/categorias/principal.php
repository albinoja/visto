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
    <p class="Panel PanelCate"><b>Panel Categorías</b></p>
</div>
<div class="table-responsive" id="DataPanelCategorias">
    <a href="" class="btn text-white" id="BtnNewCate"><i class="fa-solid fa-plus"></i> Nueva Categoria</a>
    <hr>
    <?php if ($result && $result->num_rows > 0) : ?>
        <table class="table table-bordered table-hover table-borderless" style="margin: 0 auto; width: 80%">
            <thead style="vertical-align: middle; text-align: center;">
                <tr>
                    <th>N°</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody style="vertical-align: middle; text-align: center;">
                <?php foreach ($result as $data) : ?>
                    <?php
                    $query = "SELECT COUNT(idcategoria) as contId FROM productos WHERE idcategoria='" . $data['idcategoria'] . "'";
                    $result2 = $conn->query($query);
                    $row2 = $result2->fetch_assoc();
                    $contIdCate = $row2['contId'];
                    ?>
                    <tr>
                        <td><?php echo ++$cont; ?></td>
                        <td><?php echo $data['categoria']; ?></td>
                        <td><?php echo ($data['estado'] == 1) ? '<b style="color:green;">Activo</b>' : '<b style="color:red;">Inactivo</b>'; ?></td>
                        <td>
                            <a href="" class="btn text-white BtnUpdateCate"
                            style="background-color: #4caf50;" idcategoria="<?php echo $data['idcategoria']; ?>" ><i class="fa-regular fa-pen-to-square"></i>Actualizar</a>
                        </td>
                        <td>
                            <?php if ($contIdCate == 0) : ?>
                                <a href="" class="btn text-white BtnDeleteCate" idcategoria="<?php echo $data['idcategoria']; ?>" style="background-color: #F44336;"><i class="fa-solid fa-trash-can"></i>Eliminar</a>
                            <?php else : ?>
                                <a href="" class="btn text-white" style="background-color: #ccc; cursor: not-allowed;" onclick="return false;"><i class="fa-solid fa-trash-can"></i>Eliminar</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-danger">
            <b>No se encuentran datos........</b>
        </div>
    <?php endif ?>
    <?php cerrar_db(); ?>
</div>

<script>
    $(document).ready(function() {
        //
        $("#BtnNewCate").click(function() {
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
        $(".BtnUpdateCate").click(function() {
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
        $("#ProcesoBotonModal").click(function() {
            if ($('#categoria').val() === '' ||  $('#estado').val() === '' || $('#estado').val() == null) {
                alert('Por favor completa todos los campos.');
                return;
            }
            let categoria,estado;
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
                success: function(response) {
                    $("#ModalPrincipal").modal("hide");
                    $('#categoria').val('');
                    $('#estado').val('');
                    $("#DataPanelCategorias").html(response);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return false;
        });
        // Proceso Update
        $("#ProcesoBotonModal2").click(function() {
            if ($('#categoria').val() === '' ||  $('#estado').val() === '' || $('#estado').val() == null) {
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
                success: function(response) {
                    $("#ModalPrincipal").modal("hide");
                    $('#categoria').val('');
                    $('#estado').val('');
                    $("#DataPanelCategorias").html(response);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return false;
        });
        // Proceso Delete
        $('.BtnDeleteCate').click(function() {
            var respuesta = confirm('¿Desea eliminar la categoría?');
            let idcategoria = $(this).attr('idcategoria');

            if (respuesta) {
                $.ajax({
                    type: 'POST',
                    url: './views/categorias/del.php',
                    data: {
                        idcategoria: idcategoria
                    },
                    success: function(response) {
                        $("#DataPanelCategorias").html(response);
                    },
                    error: function(xhr, status, error) {
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