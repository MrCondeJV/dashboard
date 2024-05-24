<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["usuario"]) && !empty($_POST["contrasena"])) {
        include "./conexion.php"; // Asegúrate de incluir la conexión aquí para usar $mysqli

        $nombre = $mysqli->real_escape_string($_POST["nombre"]);
        $usuario = $mysqli->real_escape_string($_POST["usuario"]);
        $contrasena = hash('sha1',$mysqli->real_escape_string($_POST["contrasena"]));
        $rol = $mysqli->real_escape_string($_POST["rol"]);

        $sql = $mysqli->query("INSERT INTO usuarios (Nombre, Usuario, contrasena, ID_Rol) VALUES ('$nombre', '$usuario', '$contrasena', '$rol')");

        if ($sql) {
            echo "<script>
            alert('Usuario Registrado Correctamente!!');
            document.location='usuarios.php';
            </script>";
        } else {
            echo "<script>
            alert('Error al registrar: " . $mysqli->error . "');
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
