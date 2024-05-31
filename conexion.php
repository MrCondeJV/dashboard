<?php
$mysqli = new mysqli('15.235.86.58', 'esfimedu_luis', 'k%-eDD4n3xDz', 'esfimedu_db_das_esfim');

if ($mysqli->connect_error) {
    die("Error de conexion: " . $mysqli->connect_error);
}
?>
