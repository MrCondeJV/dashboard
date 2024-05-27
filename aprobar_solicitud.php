<?php
include "./conexion.php";

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
        $estado = 'Aprobada'; // Estado de la solicitud aprobada

        // Insertar en el historial
        $sql_historial = $mysqli->query("INSERT INTO historial (cod_ticket, fecha_prestamo, solicitante, aula_solicitada, estado) VALUES ('$cod_ticket', '$fecha_prestamo', '$solicitante', '$aula_solicitada', '$estado')");
        
        if ($sql_historial) {
            // Eliminar la solicitud de la tabla solicitudes
            $sql_delete = $mysqli->query("DELETE FROM solicitudes WHERE id = '$solicitud_id'");
            if ($sql_delete) {
                echo "<script>
                alert('Solicitud aprobada correctamente!');
                document.location='tickets.php';
                </script>";
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
