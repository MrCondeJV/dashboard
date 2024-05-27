<?php
// detalle_prestamo.php
include "./conexion.php"; // Incluye tu archivo de conexión a la base de datos

$id = $_GET['id']; // Obtener el ID del préstamo de la solicitud GET

$query = $mysqli->prepare("SELECT * FROM respaldo_solicitudes WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    echo json_encode($data);
} else {
    echo json_encode(["error" => "No se encontraron datos"]);
}

$query->close();
$mysqli->close();
?>
