<?php
// Importar PHPMailer sin Composer
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Información de la base de datos
$host = 'localhost';
$usuario = 'root';
$password = '';
$base_datos = 'sciv';

// Información de correo
$from_email = 'jovelrafaelalberto@gmail.com';
$email_password = 'xcrh fjhn ipee umzz';
$to_email = 'albinopaypal@gmail.com';

// Directorio temporal en el servidor donde se guardará el archivo de respaldo
$backup_dir = sys_get_temp_dir();
$filename = $base_datos . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
$backup_file = $backup_dir . DIRECTORY_SEPARATOR . $filename;

// Comando mysqldump para crear el respaldo
$comando = "C:\\xampp\\mysql\\bin\\mysqldump --user={$usuario} --password={$password} --host={$host} {$base_datos} > {$backup_file}";

// Ejecutar el comando
system($comando, $resultado);

if ($resultado === 0) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $from_email;
        $mail->Password = $email_password;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($from_email, 'Backup System');
        $mail->addAddress($to_email);
        $mail->Subject = 'Backup de la Base de Datos';
        $mail->Body = 'Adjunto encontrarás el respaldo de la base de datos.';
        $mail->addAttachment($backup_file);

        $mail->send();
        $mensaje = 'El correo fue enviado exitosamente a ' . $to_email . '.';
        unlink($backup_file);
    } catch (Exception $e) {
        $mensaje = 'Hubo un error al enviar el correo: ' . $mail->ErrorInfo;
    }
} else {
    $mensaje = 'Hubo un error al realizar el respaldo.';
}

echo json_encode(['success' => $resultado === 0, 'message' => $mensaje]);
?>