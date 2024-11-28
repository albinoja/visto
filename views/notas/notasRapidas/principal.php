<?php
@session_start();
include '../../../models/conexion.php';
include '../../../controllers/controllersFunciones.php';
$conn = conectar_db();

$sql = "SELECT * FROM notas";

$result = $conn->query($sql);
$cont = 0;
?>
<div>
    <p class="Panel PanelNotas"><b>Panel de notas Rapidas</b></p>

</div>
<br><br><br>



<form action="insert.php" method="POST" id="note-form">
    <input type="text" id="note-input" name="note" placeholder="Escribe tu anotación aquí" required>
    <button type="submit" id="save-button">Guardar</button>
</form>



    <div id="notes-list">
            <h2>Anotaciones guardadas:</h2>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($data = $result->fetch_assoc()): ?>
                    <div class="note-item">
                        <div><?php echo nl2br(htmlspecialchars($data['notas'])); ?></div>
                        <div class="note-actions">
                            <a href="" idnota="<?php echo $data['id']; ?>" class="btn btn-edit BtnUpdateNota">
                                <i class="fa-regular fa-pen-to-square"></i> Editar
                            </a>


                            <a href="#" class="btn btn-delete BtnDeleteNote" idnota="<?php echo $data['id']; ?>" onclick="return false;">
                                <i class="fa-solid fa-trash-can"></i> Eliminar
                            </a>

                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="alert alert-info">
                    No hay notas guardadas.
                </div>
            <?php endif; ?>
        </div>


<script>
    $(document).ready(function() {
        $('#note-form').submit(function(event) {
            event.preventDefault(); // Evitar el envío normal del formulario

            $.ajax({
                type: 'POST',
                url: './views/notas/notasRapidas/insert.php',
                data: $(this).serialize(), // Serializar el formulario
                success: function(response) {
                    // Cargar la respuesta en el div
                    $('#sub-data').html(response);
                },
                error: function() {
                    alert('Error al guardar la nota.');
                }
            });
        });
    });

    $(".BtnUpdateNota").click(function () {
    let idnota = $(this).attr("idnota");

    // Mostrar el modal de notas
    $("#ModalNotas").modal("show");
    $('#DataEfectosModalNota').addClass('modal-dialog modal-dialog-centered modal-dialog-scrollable');
    document.getElementById("DataTituloModalNota").innerHTML = 'Modificar Nota';

    // Cargar el formulario de actualización de notas dentro del modal
    $("#DataActualizarNota").load("./views/notas/notasRapidas/form_update.php?idnota=" + idnota);

    $('#ProcesoBotonModalNota').css('display', 'none');
    $('#ProcesoBotonModalNota2').css('display', 'block');
    document.getElementById("TituloBotonModalNota2").innerHTML = 'Actualizar';

    return false; // Evitar el comportamiento predeterminado del clic
});


// Delegar el evento de clic al botón de actualización después de que el contenido del modal se cargue// Validar el formulario de notas antes de la actualización
$(document).on("click", "#ProcesoBotonModalNota2", function () {
    // Deshabilitar el botón
    $(this).prop('disabled', true);

    // Obtener los valores del formulario
    let idnota = $('#idnota').val();
    let nota = $('#nota').val();

    // Validar que el campo de la nota no esté vacío
    if (nota === '') {
        showInfoModal('Por favor ingresa una nota.'); // Mostrar mensaje
        $(this).prop('disabled', false); // Habilitar el botón
        return;
    }

    // Preparar los datos del formulario para enviarlos por AJAX
    var formData = {
        idnota: idnota,
        nota: nota
    };

    // Enviar los datos por AJAX
    $.ajax({
        type: 'POST',
        url: './views/notas/notasRapidas/update.php',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.status === "success") {
                showInfoModal(response.message); // Mostrar mensaje de éxito
                $("#ModalNotas").modal("hide");  // Cerrar el modal
                $("#sub-data").load("./views/notas/notasRapidas/principal.php");  // Actualizar el contenido
            } else {
                showInfoModal(response.message); // Mostrar mensaje de error
            }
        },
        error: function(xhr, status, error) {
            showInfoModal('Error al actualizar la nota: ' + xhr.responseText); // Mostrar error
        },
        complete: function() {
            $("#ProcesoBotonModalNota2").prop('disabled', false); // Habilitar el botón nuevamente
        }
    });

    return false; // Evitar que el formulario se envíe de forma tradicional
});


function showInfoModal(message) {
    // Establece el contenido del modal
    $("#infoModalBody").text(message);
    
    // Muestra el modal
    $("#infoModal").modal("show");

    // Cierra el modal después de 3 segundos (3000 ms)
    setTimeout(function() {
        $("#infoModal").modal("hide");
    }, 3000);
}

// Lógica para mostrar el modal con el mensaje de éxito
function showInfoModal(success) {
    if (success) {
        document.getElementById("successGif").style.display = "block"; // Mostrar el GIF
        document.getElementById("modalMessage").innerText = "¡Datos agregados correctamente!"; // Mensaje de éxito
    } else {
        document.getElementById("successGif").style.display = "none"; // Ocultar el GIF
        document.getElementById("modalMessage").innerText = "Error al agregar los datos."; // Mensaje de error
    }

    $("#infoModal").modal("show"); // Mostrar el modal

    // Cerrar el modal automáticamente después de 3 segundos
    setTimeout(function () {
        $("#infoModal").modal("hide"); // Cerrar el modal
    }, 3000); // 3000 milisegundos = 3 segundos
}




    $(document).ready(function() {
        // Proceso Delete
        $('.BtnDeleteNote').click(function() {
            var respuesta = confirm('¿Estás seguro de que quieres eliminar esta nota?');
            let idnota = $(this).attr('idnota');

            if (respuesta) {
                // Realizar la solicitud AJAX
                $.ajax({
                    type: 'POST',
                    url: './views/notas/notasRapidas/del.php',  // Ruta del archivo PHP que maneja la eliminación
                    data: { id: idnota },  // Enviar el id de la nota al servidor
                    success: function(response) {
                        // Actualizar el área donde se muestran las notas o recargar la página
                        $("#sub-data").html(response);  // O cargar las notas actualizadas
                    },
                    error: function(xhr, status, error) {
                        alert('Error al eliminar la nota: ' + xhr.responseText);
                    }
                });
            } else {
                // Si el usuario cancela, no hacer nada
                alert('Eliminación cancelada');
            }
            return false;  // Evitar la acción predeterminada del enlace
        });
    });
</script>






