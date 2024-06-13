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

    <title>Historial | ESFIM</title>

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
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

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

        <!-- Formulario -->








        <!-- Fin Formulario -->







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
                        <h1 class="h3 mb-0 text-gray-800">Historial</h1>
                        <a href="generar_pdf.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
                    </div>


                    <div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded border-left-info">

                        <div class="card-header bg-primary text-white  ">
                            Historial de Prestamos

                        </div>
                        <div class="card-body ">


                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Codigo Ticket</th>
                                            <th>Fecha Prestamo</th>
                                            <th>Solicitante</th>
                                            <th>Aula Solicitada</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Termino</th>
                                            <th>Validador</th>
                                            <th>Estado</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "./conexion.php";
                                        $sql = $mysqli->query("SELECT * FROM historial");
                                        while ($datos = $sql->fetch_object()) { ?>

                                            <tr>
                                                <td><?php echo $datos->ID ?></td>
                                                <td><?php echo $datos->cod_ticket ?></td>
                                                <td><?php echo $datos->fecha_prestamo ?></td>
                                                <td><?php echo $datos->solicitante ?></td>
                                                <td><?php echo $datos->aula_solicitada ?></td>
                                                <td><?php echo $datos->fecha_inicial ?></td>
                                                <td><?php echo $datos->fecha_final ?></td>
                                                <td><?php echo $datos->aprueba ?></td>
                                                <td>
                                                    <?php if ($datos->estado == "Aprobada") { ?>
                                                        <button class="btn btn-success btn-sm"><?php echo $datos->estado ?></button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-danger btn-sm"><?php echo $datos->estado ?></button>
                                                    <?php } ?>
                                                </td>


                                            </tr>

                                        <?php }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>

                    <!-- Dialogo de Mostrar info detallada -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle del Préstamo</h1>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>ID</th>
                                                <td id="detalle-id"></td>
                                            </tr>
                                            <tr>
                                                <th>Nro. Documento</th>
                                                <td id="detalle-nro-documento"></td>
                                            </tr>
                                            <tr>
                                                <th>Nombre Solicitante</th>
                                                <td id="detalle-nombre-solicitante"></td>
                                            </tr>
                                            <tr>
                                                <th>Unidad de Trabajo</th>
                                                <td id="detalle-unidad-trabajo"></td>
                                            </tr>
                                            <tr>
                                                <th>Correo</th>
                                                <td id="detalle-correo"></td>
                                            </tr>
                                            <tr>
                                                <th>Teléfono</th>
                                                <td id="detalle-telefono"></td>
                                            </tr>
                                            <tr>
                                                <th>Aula</th>
                                                <td id="detalle-aula"></td>
                                            </tr>
                                            <tr>
                                                <th>Descripción del Evento</th>
                                                <td id="detalle-descripcion-evento"></td>
                                            </tr>
                                            <tr>
                                                <th>Cantidad de Personas</th>
                                                <td id="detalle-cantidad-personas"></td>
                                            </tr>
                                            <tr>
                                                <th>Fecha</th>
                                                <td id="detalle-fecha"></td>
                                            </tr>
                                            <tr>
                                                <th>Hora Inicial</th>
                                                <td id="detalle-hora-inicial"></td>
                                            </tr>
                                            <tr>
                                                <th>Hora Final</th>
                                                <td id="detalle-hora-final"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Función para llenar el modal con datos
                        function mostrarDetallePrestamo(id) {
                            $.ajax({
                                url: 'detalle_prestamo.php',
                                type: 'GET',
                                data: {
                                    id: id
                                },
                                success: function(response) {
                                    const datos = JSON.parse(response);
                                    if (datos.error) {
                                        alert(datos.error);
                                    } else {
                                        document.getElementById('detalle-id').textContent = datos.id;
                                        document.getElementById('detalle-nro-documento').textContent = datos.nro_documento;
                                        document.getElementById('detalle-nombre-solicitante').textContent = datos.nombre_solicitante;
                                        document.getElementById('detalle-unidad-trabajo').textContent = datos.unidad_trabajo;
                                        document.getElementById('detalle-correo').textContent = datos.correo;
                                        document.getElementById('detalle-telefono').textContent = datos.telefono;
                                        document.getElementById('detalle-aula').textContent = datos.aula;
                                        document.getElementById('detalle-descripcion-evento').textContent = datos.descripcion_evento;
                                        document.getElementById('detalle-cantidad-personas').textContent = datos.cantidad_personas;
                                        document.getElementById('detalle-fecha-inicial').textContent = datos.fecha_inicial;
                                        document.getElementById('detalle-fecha-final').textContent = datos.fecha_final;
                                        

                                        // Mostrar el modal
                                        var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                                        myModal.show();
                                    }
                                },
                                error: function() {
                                    alert('Error al obtener los datos del préstamo.');
                                }
                            });
                        }
                    </script>


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