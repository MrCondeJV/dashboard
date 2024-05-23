<?php

if (!empty($_POST["btnAgregarUsuario"])) {
    if (!empty($_POST["nombre"]) and !empty($_POST["apellido"])and !empty($_POST["dni"])and !empty($_POST["fecha"])and !empty($_POST["email"])) {

        $nombre =$_POST["nombre"];
        $apellido =$_POST["apellido"];
        $dni =$_POST["dni"];
        $fecha =$_POST["fecha"];
        $email =$_POST["email"];

        $sql=$conexion -> query("INSERT INTO persona(nombre,apellido,dni,fecha_nac,correo) values ('$nombre','$apellido','$dni','$fecha','$email')");
        if($sql==1){
            echo '<div class="alert alert-success"> Persona Registrada Correctamente</div>';
        }else{
            echo '<div class="alert alert-danger"> Error al Registrar a la persona</div>';
        }

    }else{
        echo '<div class="alert alert-warning"> Alguno de los campos faltan por llenar</div>';
    }
}



?>
