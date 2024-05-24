<?php
$mysqli = new mysqli("localhost", "root", "", "db_das_esfim");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>
