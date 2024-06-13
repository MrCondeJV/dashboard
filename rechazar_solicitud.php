<?php
include "./conexion.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();

$aprueba = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Desconocido';

function sendRejectionEmail($to, $subject, $body) {
    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;

        $email = 'servicios.esfim@hotmail.com';
        $mail->Username = $email;
        $mail->Password = 'paryliptiyigykze';

        $mail->setFrom($email, 'Notificaciones ESFIM');
        $mail->addAddress($to);

        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = $body;

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

    $result = $mysqli->query("SELECT * FROM solicitudes WHERE id = '$solicitud_id'");
    if ($result) {
        $solicitud = $result->fetch_object();
        $cod_ticket = $solicitud->id;
        $fecha_prestamo = date('Y-m-d H:i:s');
        $solicitante = $solicitud->nombre_solicitante;
        $aula_solicitada = $solicitud->aula;
        $correo = $solicitud->correo;
        $fecha_inicio = $solicitud->fecha_inicial ;
        $fecha_fin = $solicitud->fecha_final ;
        $estado = 'Rechazada';

        $sql_historial = $mysqli->query("INSERT INTO historial (cod_ticket, fecha_prestamo, solicitante, aula_solicitada, fecha_inicial, fecha_final, aprueba, estado) VALUES ('$cod_ticket', '$fecha_prestamo', '$solicitante', '$aula_solicitada', '$fecha_inicio', '$fecha_fin', '$aprueba', '$estado')");
        
        if ($sql_historial) {
            $sql_delete = $mysqli->query("DELETE FROM solicitudes WHERE id = '$solicitud_id'");
            if ($sql_delete) {
                $subject = "Solicitud de Aula Rechazada";
                $body = sprintf(
                    '<h1>Solicitud Rechazada</h1><p>Su solicitud ha sido rechazada con los siguientes detalles:</p><ul><li>ID de Solicitud: %s</li><li>Solicitante: %s</li><li>Aula Solicitada: %s</li><li>Fecha y Hora de Inicio: %s</li><li>Fecha y Hora de Fin: %s</li><li>Rechazada por: %s</li></ul>',
                    $cod_ticket,
                    $solicitante,
                    $aula_solicitada,
                    $fecha_inicio,
                    $fecha_fin,
                    $aprueba
                );
                $emailResult = sendRejectionEmail($correo, $subject, $body);
                if ($emailResult === true) {
                    echo "<script>
                    alert('Solicitud rechazada correctamente y correo enviado!');
                    document.location='tickets.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Solicitud rechazada pero error al enviar el correo: " . $emailResult . "');
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
