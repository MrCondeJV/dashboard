<?php

if (!empty($_POST["btnAgregarUsuario"])) {
    echo "<script>
    alert('todo ok!!');
   
    </script>";
    if (!empty($_POST["nombre"]) and !empty($_POST["usuario"])and !empty($_POST["contrasena"])and !empty($_POST["rol"])) {

        $nombre =$_POST["nombre"];
        $usuario =$_POST["usuario"];
        $contrasena =$_POST["contrasena"];
        $rol =intval($_POST["rol"]);
       

        $sql=$conexion -> query("INSERT INTO usuarios(Nombre,Usuario,contrasena,ID_Rol) values ('$nombre','$usuario','$contrasena','$rol')");
        if($sql==1){
            echo "<script>
            alert('Usuario Registrado Correctamente!!');
           
            </script>";
      

        }else{
            echo "<script>
            alert('Error al registrar!!');
            document.location='usuarios.php';
            </script>";

            
        }

    }else{
      
        echo "<script>
        alert('Faltan Campos!!');
        document.location='usuarios.php';
        </script>";
    }
}



?>
