<?php
if (!empty($_GET["id"])) {
    include "./conexion.php"; // Asegúrate de incluir la conexión aquí para usar $mysqli

    $id = $mysqli->real_escape_string($_GET["id"]);

    $sql = $mysqli->query("DELETE FROM usuarios WHERE ID='$id'");

    if ($sql) {
        echo "<script>
        alert('Usuario Eliminado Correctamente!!');
        document.location='usuarios.php';
        </script>";
    } else {
        echo "<script>
        alert('Error al eliminar: " . $mysqli->error . "');
        document.location='usuarios.php';
        </script>";
    }
} else {
    echo "<script>
    alert('ID de usuario no especificado!!');
    document.location='usuarios.php';
    </script>";
}
?>
