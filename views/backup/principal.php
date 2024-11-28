<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

// Consultar el último backup realizado
$sql = "SELECT fechaRealizado FROM backups ORDER BY fechaRealizado DESC LIMIT 1";
$result = $conn->query($sql);

// Verificar si hay registros
$ultimo_backup = ($result->num_rows > 0) ? $result->fetch_assoc()['fechaRealizado'] : "No hay registros de backups";

?>
<div>
    <p style="text-align: center;"><b>Backups realizados</b></p>
</div>

<div class="backup-info">
    <strong>Último Backup Realizado:</strong>
    <em><?php echo $ultimo_backup; ?></em>
</div>


<div class="button-container">
    <a href="#" class="button button-1" role="button" aria-label="Botón 1">
        Restaurar Datos
    </a>
    <form method="post" action="./views/backup/backupLocal.php">
        <a href="#" onclick="this.closest('form').submit();" class="button button-2" role="button"
            aria-label="Backup Local">
            Backup Local
        </a>
    </form>
    <form id="backupEmailForm" method="post" action="./views/backup/backupEmail.php">
        <a href="#" onclick="event.preventDefault(); realizarBackupEmail();" class="button button-3" role="button"
            aria-label="Backup Correo Electrónico">
            Backup Correo Electrónico
        </a>
    </form>
</div>

<!-- Contenedor para el mensaje de resultado -->
<div id="backupResult" style="margin-top: 20px;"></div>

<!-- Overlay para desactivar la pantalla -->
<div id="overlay"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white;">
        Enviando correo, por favor espere...
    </div>
</div>

<!-- Asegúrate de que jQuery esté incluido -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        // Función para manejar la solicitud de Backup por Email sin recargar la página
        window.realizarBackupEmail = function () {
            // Mostrar el overlay
            $('#overlay').show();

            $.ajax({
                type: 'POST',
                url: './views/backup/backupEmail.php',
                dataType: 'json',
                success: function (response) {
                    // Mostrar un mensaje de confirmación basado en la respuesta JSON
                    if (response.success) {
                        $('#backupResult').html('<div class="alert alert-success" role="alert">Backup realizado con éxito por correo electrónico.</div>');
                    } else {
                        $('#backupResult').html('<div class="alert alert-danger" role="alert">Error al realizar el Backup por correo electrónico.</div>');
                    }
                },
                error: function (xhr, status, error) {
                    $('#backupResult').html('<div class="alert alert-danger" role="alert">Error al realizar el Backup por correo electrónico.</div>');
                },
                complete: function () {
                    // Ocultar el overlay después de completar la solicitud
                    $('#overlay').hide();
                }
            });
        }
    });
</script>