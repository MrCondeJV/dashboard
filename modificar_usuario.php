<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["nombremod"]) && !empty($_POST["usuariomod"]) && !empty($_POST["contraseñamod"])) {
        include "./conexion.php"; // Asegúrate de incluir la conexión aquí para usar $mysqli

        $id = $mysqli->real_escape_string($_GET["id"]);
        $nombre = $mysqli->real_escape_string($_POST["nombremod"]);
        $usuario = $mysqli->real_escape_string($_POST["usuariomod"]);
        $contrasena = hash('sha1', $mysqli->real_escape_string($_POST["contraseñamod"]));
        $rol = $mysqli->real_escape_string($_POST["rolmod"]);

        $sql = $mysqli->query("UPDATE usuarios SET Nombre='$nombre', Usuario='$usuario', contrasena='$contrasena', ID_Rol='$rol' WHERE ID='$id'");

        if ($sql) {
            echo "<script>
            alert('Usuario Modificado Correctamente!!');
            document.location='usuarios.php';
            </script>";
        } else {
            echo "<script>
            alert('Error al modificar: " . $mysqli->error . "');
            document.location='usuarios.php';
            </script>";
        }
    } else {
        echo "<script>
        alert('Faltan Campos!!');
        </script>";
    }
}
?>
