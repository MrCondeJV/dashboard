<?php
if (!empty($_POST["btnSolicitarAula"])) {
    ob_start(); // Iniciar el buffer de salida

    // Verificación de reCAPTCHA
    $recaptchaSecret = '6LdL3-kpAAAAAP3wnnkgYITLKzKAO1qtOSmTIYHS';
    $response = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];

    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaResponse = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $response . '&remoteip=' . $remoteIp);
    $recaptchaData = json_decode($recaptchaResponse);

    if ($recaptchaData->success) {
        if (!empty($_POST["identificacion"]) && !empty($_POST["nombreCompleto"]) && !empty($_POST["unidad"]) && !empty($_POST["correo"]) && !empty($_POST["telefono"]) && !empty($_POST["aula"]) && !empty($_POST["descripcion"]) && !empty($_POST["nroPersonas"]) && !empty($_POST["fecha_inicio"]) && !empty($_POST["fecha_terminacion"]) && !empty($_FILES["archivo_pdf"])) {
            include "./conexion.php"; // Asegúrate de incluir la conexión aquí para usar $mysqli

            $identificacion = $mysqli->real_escape_string($_POST["identificacion"]);
            $solicitante = $mysqli->real_escape_string($_POST["nombreCompleto"]);
            $unidad = $mysqli->real_escape_string($_POST["unidad"]);
            $correo = $mysqli->real_escape_string($_POST["correo"]);
            $telefono = $mysqli->real_escape_string($_POST["telefono"]);
            $aula = $mysqli->real_escape_string($_POST["aula"]);
            $descripcion = $mysqli->real_escape_string($_POST["descripcion"]);
            $nroPersonas = $mysqli->real_escape_string($_POST["nroPersonas"]);
            $fecha_inicio = $mysqli->real_escape_string($_POST["fecha_inicio"]);
            $fecha_terminacion = $mysqli->real_escape_string($_POST["fecha_terminacion"]);

            // Validación y subida del archivo PDF
            $targetDir = "uploads/";
            $fileName = basename($_FILES["archivo_pdf"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Verificar si el archivo es un PDF
            if ($fileType != "pdf") {
                ob_end_clean();
                echo "<script>
                alert('Solo se permiten archivos PDF.');
                document.location='principal.html';
                </script>";
                exit;
            }

            // Subir el archivo al servidor
            if (!move_uploaded_file($_FILES["archivo_pdf"]["tmp_name"], $targetFilePath)) {
                ob_end_clean();
                echo "<script>
                alert('Error al subir el archivo.');
                document.location='principal.html';
                </script>";
                exit;
            }

            // Convertir las fechas y horas a DateTime para la comparación
            $inicio_dt = new DateTime($fecha_inicio);
            $fin_dt = new DateTime($fecha_terminacion);

            if ($fin_dt <= $inicio_dt) {
                ob_end_clean(); // Limpiar el buffer de salida antes de enviar el header
                echo "<script>
                alert('La fecha y hora final no pueden ser menores o iguales a la fecha y hora inicial.');
                document.location='principal.html';
                </script>";
                exit;
            }

            // Convertir DateTime a formato string para la consulta SQL
            $inicio_str = $inicio_dt->format('Y-m-d H:i:s');
            $fin_str = $fin_dt->format('Y-m-d H:i:s');

            // Verificar si hay solapamientos en las fechas y horas con otros registros
            $query = "SELECT * FROM solicitudes WHERE aula = '$aula' AND (
                        ('$inicio_str' < fecha_final AND '$fin_str' > fecha_inicial) OR
                        ('$inicio_str' <= fecha_inicial AND '$fin_str' >= fecha_final)
                    )";

            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                ob_end_clean(); // Limpiar el buffer de salida antes de enviar el header
                echo "<script>
                alert('Las fechas y horas solicitadas se solapan con otra reserva.');
                document.location='principal.html';
                </script>";
                exit;
            }

            $sql = $mysqli->query("INSERT INTO solicitudes (nro_documento, nombre_solicitante, unidad_trabajo, correo, telefono, aula, descripcion_evento, cantidad_personas, fecha_inicial, fecha_final, docPdf) VALUES ('$identificacion','$solicitante', '$unidad', '$correo', '$telefono', '$aula', '$descripcion', '$nroPersonas', '$inicio_str', '$fin_str', '$fileName')");

            if ($sql) {
                ob_end_clean(); // Limpiar el buffer de salida antes de enviar el header
                echo "<script>
                alert('Solicitud registrada correctamente.');
                window.location.href = 'post_gmail.php';
                </script>";
                
                exit();
            } else {
                ob_end_clean(); // Limpiar el buffer de salida antes de enviar el header
                echo "<script>
                alert('Error al registrar la solicitud: " . $mysqli->error . "');
                document.location='principal.html';
                </script>";
            }
        } else {
            ob_end_clean(); // Limpiar el buffer de salida antes de enviar el header
            echo "<script>
            alert('Faltan Campos!!');
            document.location='principal.html';
            </script>";
        }
    } else {
        ob_end_clean(); // Limpiar el buffer de salida antes de enviar el header
        echo "<script>
        alert('Error en la validación de reCAPTCHA.');
        document.location='principal.html';
        </script>";
    }
}
?>
