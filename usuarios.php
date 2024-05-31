<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


$nombre = $_SESSION['nombre'];
$rol = $_SESSION['ID_Rol']
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Usuarios | ESFIM</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="./img/esfim_logo.png" alt="ESFIM Logo" class="img-fluid sidebar-logo" style="max-width: 60px; height: auto;" srcset="">
                </div>
                <div class="sidebar-brand-text mx-3">ESFIM</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menú
            </div>


           <!-- Nav Item - Tables -->
           <li class="nav-item">
                <a class="nav-link" href="calendario.php">
                    <i class="fas fa-fw fa-calendar-day"></i>
                    <span>Calendario</span></a>
            </li>
             <!-- Nav Item - Tables -->
             <li class="nav-item">
                    <a class="nav-link" href="tickets.php">
                        <i class="fas fa-fw fa-tags"></i>
                        <span>Tickets</span></a>
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="historial.php">
                        <i class="fas fa-fw fa-sitemap"></i>
                        <span>Historial</span></a>
                </li>


            <?php if ($rol == 1) { ?>

               
                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Usuarios</span></a>
                </li>


            <?php } ?>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php
                                                                                            echo $nombre;

                                                                                            ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./cerrar_sesion.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2>Administracion de <b>Usuarios</b></h2>

                    </div>

                    <!-- TABLA CRUD DE USUARIOS -->



                    <div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded border-left-primary">

                        <div class="card-header bg-primary text-white  ">
                            Tabla de Usuarios

                        </div>
                        <div class="card-body">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Agregar usuario
                            </button>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "./conexion.php";
                                        $sql = $mysqli->query("SELECT * FROM usuarios");
                                        while ($datos = $sql->fetch_object()) { ?>

                                            <tr>
                                                <td><?php echo $datos->ID ?></td>
                                                <td><?php echo $datos->Nombre ?></td>
                                                <td><?php echo $datos->Usuario ?></td>
                                                <td><?php echo $datos->contrasena ?></td>
                                                <td><?php echo $datos->ID_Rol ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdropMod<?php echo $datos->ID; ?>">Editar</a>
                                                    <a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $datos->ID; ?>)">Eliminar</a>
                                                </td>
                                            </tr>

                                            <!-- Dialogo de Confirmacion para Modificar Usuario -->
                                            <div class="modal fade" id="staticBackdropMod<?php echo $datos->ID; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropModLabel<?php echo $datos->ID; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropModLabel<?php echo $datos->ID; ?>">Modificar Usuario</h1>
                                                        </div>
                                                        <form method="POST" action="./modificar_usuario.php?id=<?php echo $datos->ID; ?>">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nombre Completo</label>
                                                                    <input type="text" class="form-control" name="nombremod" placeholder="Nombre" value="<?php echo $datos->Nombre; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Usuario</label>
                                                                    <input type="text" class="form-control" name="usuariomod" placeholder="Usuario" value="<?php echo $datos->Usuario; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Password</label>
                                                                    <input type="text" class="form-control" name="contraseñamod" placeholder="Password" value="<?php echo $datos->contrasena; ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Rol</label>
                                                                    <select class="form-select" name="rolmod">
                                                                        <option value="<?php echo $datos->ID_Rol; ?>"><?php echo $datos->ID_Rol; ?></option>
                                                                        <option value="1">1- Administrador</option>
                                                                        <option value="2">2- Observador</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-warning" name="btnmodificar" value="ok">Modificar</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Dialogo de Confirmacion para agregarUsuario -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Usuario</h1>
                                        </div>
                                        <form method="POST" action="agregar_usuario.php">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre Completo</label>
                                                    <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Usuario</label>
                                                    <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="contrasena" placeholder="Password">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Rol</label>
                                                    <select class="form-select" name="rol">
                                                        <option value="1">1- Administrador</option>
                                                        <option value="2">2- Observador</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="btnregistrar" value="ok">Agregar</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function confirmarEliminacion(id) {
                                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                                    window.location.href = "eliminar_usuario.php?id=" + id;
                                }
                            }
                        </script>



                        <!-- FIN Dialogo de Confirmacion para Modificar Usuario -->


                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; División de Tecnologías de la Información y de las Comunicaciones ESFIM </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Desea Cerrar Sesión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="./cerrar_sesion.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>