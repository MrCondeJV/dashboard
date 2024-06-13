<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que esta línea apunta a la ubicación correcta

function clean($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

try {
    // Definir las variables directamente
    $asunto = clean("SOLICITUD DE AULA");
    $contenido = clean("Buen día Señor, tiene solicitudes pendientes en la plataforma de prestamo de aulas. Por favor, visite el siguiente enlace:");
    $enlace = "https://servicios.esfim.edu.co/principal.html";
    $para = array("lbarriosmunoz1012@gmail.com", "gmora@esfim.edu.co", "jonathan.rodriguez@esfim.edu.co", "tellys.alexis@esfim.edu.co", "gilson.aranda@esfim.edu.co", "alexis.ruiz@esfim.edu.co", "diana.garcia@esfim.edu.co", "winssen.arquez@esfim.edu.co", "luis.ocampo@esfim.edu.co"); // Agrega aquí todas las direcciones de correo electrónico

    foreach ($para as $destinatario) {
        if (!filter_var($destinatario, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Dirección de correo electrónico no válida.');
        }
    }

    // Instancia de PHPMailer
    $mail = new PHPMailer(true);

    // Configuración del servidor
    $mail->isSMTP();
    $mail->SMTPDebug = 0; // Para producción, establecer a 0
    $mail->Host = 'smtp.office365.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;

    // Credenciales de la cuenta
    $email = 'servicios.esfim@hotmail.com';
    $mail->Username = $email;
    $mail->Password = 'paryliptiyigykze';

    // Quien envía este mensaje
    $mail->setFrom($email, 'Notificaciones ESFIM');

    // Agregar destinatarios
    foreach ($para as $destinatario) {
        $mail->addAddress($destinatario);
    }

    // Asunto del correo
    $mail->Subject = $asunto;

    // Contenido
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Body = sprintf('<h1>El mensaje es:</h1><br><p>%s</p><p><a href="%s">Visitar plataforma servicios ESFIM</a></p>', $contenido, $enlace);

    // Enviar el correo
    if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
    }

    header("Location: principal.html");
    echo "<script>alert('Mensaje enviado con éxito a todos los destinatarios')</script>";
    exit();
} catch (Exception $e) {
    
    echo "<script>alert('Error al enviar el correo: {$e->getMessage()}')</script>";
    header("Location: principal.html");
}
