<?php
  @session_start();
  include '../../models/conexion.php';
  include '../../controllers/controllersFunciones.php';
  $conn = conectar_db();
  $idcategoria = $_GET['idcategoria'];
  $sql = "SELECT * FROM categorias WHERE idcategoria = '$idcategoria'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $categoria = $row['categoria'];
  $estado = $row['estado'];
  $vestado = ($estado == 1)? 'Activo':'Inactivo';
?>
<input type="hidden" id="idcategoria" name="idcategoria" value="<?php echo $idcategoria;?>">
<div class="input-group mb-3">
  <span class="input-group-text"><b>Categoría</b></span>
  <textarea class="form-control" name="categoria" placeholder="Ingrese Nombres y Apellidos" id="categoria"><?php echo $categoria;?></textarea>
</div>
<div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01"><b>Estado</b></label>
  <select class="form-select" name="estado" id="estado">
    <option value="<?php echo $estado;?>" selected><?php echo $vestado?></option>
    <?php if($estado == 1):?>
      <option value="2">Inactivo</option>
    <?php else:?>
      <option value="1">Activo</option>
    <?php endif?>
  </select>
</div>