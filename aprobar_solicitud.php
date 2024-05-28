<?php
include "./conexion.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que esta línea apunta a la ubicación correcta

function sendApprovalEmail($to, $subject, $body) {
    try {
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
        $mail->Password = 'euzmgaizwfqtstht';

        // Quien envía este mensaje
        $mail->setFrom($email, 'Notificaciones ESFIM');

        // Destinatario
        $mail->addAddress($to);

        // Asunto del correo
        $mail->Subject = $subject;

        // Contenido
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $body;

        // Enviar el correo
        if (!$mail->send()) {
            throw new Exception($mail->ErrorInfo);
        }

        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

if (!empty($_POST['solicitud_id'])) {
    $solicitud_id = $mysqli->real_escape_string($_POST['solicitud_id']);

    // Obtener datos de la solicitud antes de eliminarla
    $result = $mysqli->query("SELECT * FROM solicitudes WHERE id = '$solicitud_id'");
    if ($result) {
        $solicitud = $result->fetch_object();
        $cod_ticket = $solicitud->id;
        $fecha_prestamo = date('Y-m-d H:i:s');
        $solicitante = $solicitud->nombre_solicitante;
        $aula_solicitada = $solicitud->aula;
        $correo = $solicitud->correo;
        $fecha_inicio = $solicitud->fecha . " " . $solicitud->hora_inicial;
        $fecha_fin = $solicitud->fecha . " " . $solicitud->hora_final;
        $estado = 'Aprobada'; // Estado de la solicitud aprobada

        // Insertar en el historial
        $sql_historial = $mysqli->query("INSERT INTO historial (cod_ticket, fecha_prestamo, solicitante, aula_solicitada, fecha_inicial, fecha_final, estado) VALUES ('$cod_ticket', '$fecha_prestamo', '$solicitante', '$aula_solicitada', '$fecha_inicio', '$fecha_fin', '$estado')");
        
        if ($sql_historial) {
            // Eliminar la solicitud de la tabla solicitudes
            $sql_delete = $mysqli->query("DELETE FROM solicitudes WHERE id = '$solicitud_id'");
            if ($sql_delete) {
                // Enviar correo de aprobación
                $subject = "Solicitud de Aula Aprobada";
                $body = sprintf(
                    '<h1>Solicitud Aprobada</h1><p>Su solicitud ha sido aprobada con los siguientes detalles:</p><ul><li>ID de Solicitud: %s</li><li>Solicitante: %s</li><li>Aula Solicitada: %s</li><li>Fecha y Hora de Inicio: %s</li><li>Fecha y Hora de Fin: %s</li></ul>',
                    $cod_ticket,
                    $solicitante,
                    $aula_solicitada,
                    $fecha_inicio,
                    $fecha_fin
                );
                $emailResult = sendApprovalEmail($correo, $subject, $body);
                if ($emailResult === true) {
                    echo "<script>
                    alert('Solicitud aprobada correctamente y correo enviado!');
                    document.location='tickets.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Solicitud aprobada pero error al enviar el correo: " . $emailResult . "');
                    document.location='tickets.php';
                    </script>";
                }
            } else {
                echo "<script>
                alert('Error al eliminar la solicitud: " . $mysqli->error . "');
                document.location='tickets.php';
                </script>";
            }
        } else {
            echo "<script>
            alert('Error al registrar en el historial: " . $mysqli->error . "');
            document.location='tickets.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Error al obtener los datos de la solicitud: " . $mysqli->error . "');
        document.location='tickets.php';
        </script>";
    }
} else {
    echo "<script>
    alert('Falta el ID de la solicitud.');
    document.location='tickets.php';
    </script>";
}
?>
