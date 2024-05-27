<?php
// Incluir el archivo de conexión a la base de datos
include "./conexion.php";

// Verificar si se recibió un ID de solicitud
if (isset($_GET['id'])) {
    // Obtener el ID de la solicitud desde la solicitud AJAX
    $id_solicitud = $_GET['id'];

    // Consulta para obtener los detalles de la solicitud
    $query = "SELECT * FROM historial WHERE ID = $id_solicitud"; // Asegúrate de ajustar el nombre de la tabla y las columnas según tu base de datos
    $result = $mysqli->query($query);

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Inicializar una variable para almacenar los detalles de la solicitud
        $detalles_solicitud = '';

        // Obtener los detalles de la solicitud y formatearlos en HTML
        while ($row = $result->fetch_assoc()) {
            $detalles_solicitud .= '<tr>';
            $detalles_solicitud .= '<th>ID</th><td>' . $row['ID'] . '</td>'; // Cambia 'ID' por el nombre de la columna que contiene el ID de la solicitud
            $detalles_solicitud .= '</tr>';
            $detalles_solicitud .= '<tr>';
            $detalles_solicitud .= '<th>Código de Ticket</th><td>' . $row['cod_ticket'] . '</td>'; // Cambia 'cod_ticket' por el nombre de la columna que contiene el código de ticket
            $detalles_solicitud .= '</tr>';
            // Agrega más filas para otras columnas que deseas mostrar
        }

        // Devolver los detalles de la solicitud en HTML
        echo $detalles_solicitud;
    } else {
        echo '<tr><td colspan="2">No se encontraron detalles para esta solicitud.</td></tr>';
    }
} else {
    echo '<tr><td colspan="2">No se recibió un ID de solicitud.</td></tr>';
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
