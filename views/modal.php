<!-- Modal -->
<div class="modal fade" id="ModalPrincipal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div  id="DataEfectosModal" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><label id="DataTituloModal"></label></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="DataModalPrincipal">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="ProcesoBotonModal" class="btn btn-primary"><label id="TituloBotonModal"></label></button>
        <button type="button" id="ProcesoBotonModal2" class="btn btn-primary"><label id="TituloBotonModal2"></label></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalPrincipal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div  id="DataEfectosModal2" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><label id="DataTituloModal2"></label></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="DataModalPrincipal2">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="javascript:imprim2();"><i class="fa-solid fa-print"></i></button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalAlert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div  id="DataEfectosAlert" class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><b>Alerta Productos</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="DataModalAlert">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button></div>
    </div>
  </div>
</div>


<!-- Modal para Notas -->
<div class="modal fade" id="ModalNotas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModalNotasLabel" aria-hidden="true">
  <div id="DataEfectosModalNota" class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalNotasLabel"><label id="DataTituloModalNota"></label></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="DataActualizarNota">
        <!-- Aquí se cargará dinámicamente el formulario de actualización de notas -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="ProcesoBotonModalNota" class="btn btn-primary" style="display:none;"><label id="TituloBotonModalNota"></label></button>
        <button type="button" id="ProcesoBotonModalNota2" class="btn btn-primary" style="display:none;"><label id="TituloBotonModalNota2"></label></button>
      </div>
    </div>
  </div>
</div>



<!-- Modal de Información -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-info-accessible">
            <div class="modal-header">
                <h5 class="modal-title modal-title-accessible" id="infoModalLabel">Información</h5>
                <button type="button" class="btn-close btn-close-accessible" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-accessible" id="infoModalBody">
                <img src="./public/img/gif.webp" alt="Check" class="success-gif" id="successGif" style="display:none;">
                <p id="modalMessage">¡Datos agregados correctamente!</p>
            </div>
        </div>
    </div>
</div>




