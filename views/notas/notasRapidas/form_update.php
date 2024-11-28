<?php
  @session_start();
  include '../../../models/conexion.php';
  include '../../../controllers/controllersFunciones.php';
  $conn = conectar_db();


  $idnota = $_GET['idnota'];
  $sql = "SELECT * FROM notas WHERE id = '$idnota'";

  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $notas = $row['notas'];
 
?>
<input type="hidden" id="idnota" name="idnota" value="<?php echo $idnota;?>">
<div class="input-group mb-3">
  <span class="input-group-text"><b>Nota</b></span>
  <textarea class="form-control" name="nota" placeholder="Ingrese Nota" id="nota"><?php echo $notas;?></textarea>
</div>



