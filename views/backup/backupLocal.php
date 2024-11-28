<?php

// Establecer la zona horaria correcta
date_default_timezone_set('America/El_Salvador');

// Información de la base de datos
$host = 'localhost';
$usuario = 'root';
$password = '';
$base_datos = 'sciv';

// Ruta de la carpeta en el escritorio
$desktop_dir = getenv("HOMEDRIVE") . getenv("HOMEPATH") . "\\Desktop\\BackupFolder";
if (!is_dir($desktop_dir)) {
    mkdir($desktop_dir, 0777, true); // Crear la carpeta si no existe
}

// Nombre y ruta completa del archivo de respaldo
$filename = $base_datos . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
$backup_file = $desktop_dir . DIRECTORY_SEPARATOR . $filename;

// Comando mysqldump para crear el respaldo y guardarlo en la carpeta de escritorio
$comando = "C:\\xampp\\mysql\\bin\\mysqldump --user={$usuario} --password={$password} --host={$host} {$base_datos} > {$backup_file}";

// Ejecutar el comando
system($comando, $resultado);

// Verificar si el backup fue exitoso
if ($resultado === 0) {
    // Descargar el archivo directamente desde la carpeta de escritorio
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($backup_file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file));
    
    // Leer el archivo y enviarlo al navegador para descarga
    readfile($backup_file);
    
    // Registrar el backup en la base de datos
    $conexion = new mysqli($host, $usuario, $password, $base_datos);
    
    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    
    // Guardar registro en la base de datos luego de descargar el archivo
    $nombreBackup = $filename;
    $fechaRealizado = date('Y-m-d H:i:s');
    $sql = "INSERT INTO backups (nombreBackup, fechaRealizado) VALUES ('$nombreBackup', '$fechaRealizado')";
    
    if ($conexion->query($sql) === TRUE) {
        echo "Backup registrado correctamente.";
    } else {
        echo "Error al registrar el backup: " . $conexion->error;
    }
    
    // Cerrar la conexión
    $conexion->close();

    exit;
} else {
    echo "Hubo un error al realizar el respaldo.";
}
?>
