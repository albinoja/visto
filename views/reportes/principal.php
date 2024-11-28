<div>
    <p style="text-align: center;"><b>Panel Reportes</b></p>
</div>

<style>
    .bloqueado {
        pointer-events: none;
        opacity: 0.5;
        /* Puedes ajustar la opacidad para hacer el botón más transparente si lo deseas */
        cursor: not-allowed;
        /* Cambia el cursor para indicar que el botón no está disponible */
    }
</style>
<div class="row">
    <div class="col-md-3" style="margin-bottom: 5px;">
        <div class="card">
            <div class="card-header">
                <b>Ventas por fecha</b>
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><b><i class="fa-solid fa-calendar-days"></i> Inicio</b></span>
                    <input type="date" class="form-control" name="fi" id="fi">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><b><i class="fa-solid fa-calendar-days"></i> Fin</b></span>
                    <input type="date" class="form-control" name="ff" id="ff">
                </div>
                <a class="btn btn-primary" id="BtnBuscaComprobanteVenta"><b>Buscar</b></a>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <b>Resultado</b>
            </div>
            <div class="card-body" id="DataReportes">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#BtnBuscaComprobanteVenta").click(function() {
            if ($('#fi').val() === '' || $('#ff').val() === '') {
                alert('Por favor ingrese la fecha de inicio y fin para realizar la busqueda de ventas....');
                return;
            }
            let fi,ff;
            fi = $('#fi').val();
            ff = $('#ff').val();
            var formData = {
                fi: fi,
                ff: ff
            };
            $.ajax({
                type: 'POST',
                url: './views/reportes/data.php',
                data: formData,
                dataType: 'html',
                success: function(response) {
                    /*
                    $('#fi').val('');
                    $('#ff').val('');
                    */
                    $("#DataReportes").html(response);
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
            return false;
        });
    });
</script>