<?php
  @session_start();
  include '../../models/conexion.php';
  include '../../controllers/controllersFunciones.php';
  $conn = conectar_db();
  $idusuario = $_GET['idusuario'];
  $sql = "SELECT * FROM usuarios WHERE idusuario = '$idusuario'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $usuario = $row['usuario'];
  $empleado = $row['empleado'];
  $estado = $row['estado'];
  $vestado = ($estado == 1)? 'Activo':'Inactivo';
  $tipo = $row['tipo'];
  $vtipo = ($tipo == 1)? 'Administrador':'Operador';
?>
<input type="hidden" id="idusuario" name="idusuario" value="<?php echo $idusuario;?>">
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><b>Usuario</b></span>
  <input type="text" class="form-control" placeholder="Username" name="usuario" id="usuario" value="<?php echo $usuario;?>">
</div>
<div class="input-group mb-3">
  <span class="input-group-text"><b>Empleado</b></span>
  <textarea class="form-control" name="empleado" placeholder="Ingrese Nombres y Apellidos" id="empleado"><?php echo $empleado;?></textarea>
</div>
<div class="input-group mb-3">
  <span class="input-group-text"><b>Contraseña</b></span>
  <input type="text" class="form-control" placeholder="Ingrese Contraseña" name="clave" id="clave">
</div>
<div class="input-group mb-3">
  <label class="input-group-text" for="inputGroupSelect01"><b>Tipo</b></label>
  <select class="form-select" name="tipo" id="tipo">
    <option value="<?php echo $tipo;?>" selected><?php echo $vtipo;?></option>
    <?php if($tipo == 1):?>
    <option value="2">Operador</option>
    <?php else:?>
    <option value="1">Administrador</option>
    <?php endif?>
  </select>
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