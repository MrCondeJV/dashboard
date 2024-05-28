<?php
if (!empty($_POST["btnSolicitarAula"])) {
    echo "<script>console.log('Form Submitted');</script>";

    // Verificación de reCAPTCHA
    $recaptchaSecret = '6LdL3-kpAAAAAP3wnnkgYITLKzKAO1qtOSmTIYHS';
    $response = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];

    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaResponse = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $response . '&remoteip=' . $remoteIp);
    $recaptchaData = json_decode($recaptchaResponse);

    if ($recaptchaData->success) {
        echo "<script>console.log('reCAPTCHA validated');</script>";

        if (!empty($_POST["identificacion"]) && !empty($_POST["nombreCompleto"]) && !empty($_POST["unidad"]) && !empty($_POST["correo"]) && !empty($_POST["telefono"]) && !empty($_POST["aula"]) && !empty($_POST["descripcion"]) && !empty($_POST["nroPersonas"]) && !empty($_POST["fecha"]) && !empty($_POST["hora_inicial"]) && !empty($_POST["hora_final"])) {
            include "./conexion.php"; // Asegúrate de incluir la conexión aquí para usar $mysqli

            echo "<script>console.log('All fields are filled');</script>";

            $identificacion = $mysqli->real_escape_string($_POST["identificacion"]);
            $solicitante = $mysqli->real_escape_string($_POST["nombreCompleto"]);
            $unidad = $mysqli->real_escape_string($_POST["unidad"]);
            $correo = $mysqli->real_escape_string($_POST["correo"]);
            $telefono = $mysqli->real_escape_string($_POST["telefono"]);
            $aula = $mysqli->real_escape_string($_POST["aula"]);
            $descripcion = $mysqli->real_escape_string($_POST["descripcion"]);
            $nroPersonas = $mysqli->real_escape_string($_POST["nroPersonas"]);
            $fecha = $mysqli->real_escape_string($_POST["fecha"]);
            $hora_inicial = $mysqli->real_escape_string($_POST["hora_inicial"]);
            $hora_final = $mysqli->real_escape_string($_POST["hora_final"]);

            // Convertir las horas a formato de 24 horas para la comparación
            $hora_inicial_dt = new DateTime($hora_inicial);
            $hora_final_dt = new DateTime($hora_final);

            if ($hora_final_dt <= $hora_inicial_dt) {
                echo "<script>
                alert('La hora final no puede ser menor o igual a la hora inicial.');
                document.location='principal.html';
                </script>";
                exit;
            }

            // Verificar si hay solapamientos en las horas con otros registros
            $query = "SELECT * FROM solicitudes WHERE aula = '$aula' AND fecha = '$fecha' AND (
                        (hora_inicial < '$hora_final' AND hora_final > '$hora_inicial') OR
                        (hora_inicial <= '$hora_inicial' AND hora_final >= '$hora_final')
                    )";

            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                echo "<script>
                alert('Las horas solicitadas se solapan con otra reserva.');
                document.location='principal.html';
                </script>";
                exit;
            }

            $sql = $mysqli->query("INSERT INTO solicitudes (nro_documento, nombre_solicitante, unidad_trabajo, correo, telefono, aula, descripcion_evento, cantidad_personas, fecha, hora_inicial, hora_final) VALUES ('$identificacion','$solicitante', '$unidad', '$correo', '$telefono', '$aula', '$descripcion', '$nroPersonas', '$fecha', '$hora_inicial', '$hora_final')");


            if ($sql) {
                echo "<script>
                alert('Solicitud de aula registrada correctamente!!');
                document.location='principal.html';
                </script>";

                header("Location: post_gmail.php");
                exit();
            } else {
                echo "<script>
                alert('Error al registrar la solicitud: " . $mysqli->error . "');
                document.location='principal.html';
                </script>";
            }
        } else {
            echo "<script>
            alert('Faltan Campos!!');
            console.log('Missing fields: Identificacion: " . $_POST['identificacion'] . ", Nombre " . $_POST['nombreCompleto'] . ", Unidad: " . $_POST['unidad'] . ", Correo: " . $_POST['correo'] . ", Telefono: " . $_POST['telefono'] . ", Aula: " . $_POST['aula'] . ", Descripcion: " . $_POST['descripcion'] . ", NroPersonas: " . $_POST['nroPersonas'] . ", Fecha: " . $_POST['fecha'] . ", Hora Inicial: " . $_POST['hora_inicial'] . ", Hora Final: " . $_POST['hora_final'] . "');
            document.location='principal.html';
            </script>";
        }
    } else {
        echo "<script>
        alert('Error en la validación de reCAPTCHA.');
        document.location='principal.html';
        </script>";
    }
}
