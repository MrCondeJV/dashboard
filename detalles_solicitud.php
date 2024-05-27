<?php
// Incluir archivo de conexión a la base de datos
include "./conexion.php";

// Verificar si se recibieron los parámetros solicitante y aula
if (isset($_POST['solicitante']) && isset($_POST['aula'])) {
    // Obtener valores de los parámetros
    $solicitante = $mysqli->real_escape_string($_POST['solicitante']);
    $aula = $mysqli->real_escape_string($_POST['aula']);

    // Consultar la base de datos para obtener detalles de la solicitud
    $query = "SELECT * FROM historial WHERE solicitante = '$solicitante' AND aula_solicitada = '$aula'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        // Mostrar detalles de la primera fila (asumiendo que solo hay una coincidencia)
        $row = $result->fetch_assoc();
        
        $detalles = "<b>Solicitante:</b> " . $row['solicitante'] . "<br>";
        $detalles .= "<b>Aula:</b> " . $row['aula_solicitada'] . "<br>";
        $detalles .= "<b>Fecha de inicio:</b> " . $row['fecha_inicial'] . "<br>";
        $detalles .= "<b>Fecha final:</b> " . $row['fecha_final'] . "<br>";
        $detalles .= "<b>Estado:</b> " . $row['estado'] . "<br>";
        // Agrega más detalles según sea necesario
    } else {
        // No se encontraron detalles para la solicitud
        $detalles = "No se encontraron detalles para esta solicitud.";
    }

    // Devolver los detalles de la solicitud en formato HTML
    echo $detalles;
} else {
    // Si no se recibieron los parámetros correctamente
    echo "Error: No se recibieron todos los parámetros necesarios.";
}
?>
