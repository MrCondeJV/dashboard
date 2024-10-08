<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$rol = $_SESSION['ID_Rol'];

// Incluir archivo de conexión a la base de datos
include "./conexion.php";

// Consulta para obtener todas las solicitudes aprobadas
$query = "SELECT * FROM historial WHERE estado = 'aprobada'";
$result = $mysqli->query($query);

// Array para almacenar los eventos del calendario
$eventos = array();

// Recorrer los resultados y agregarlos al array de eventos
while ($row = $result->fetch_assoc()) {
    // Formatear el evento para que sea compatible con FullCalendar
    $evento = array(
        'title' => 'Evento de ' . $row['solicitante'] . ' - Aula ' . $row['aula_solicitada'],
        'start' => $row['fecha_inicial'], // Fecha de inicio del evento
        'end' => $row['fecha_final'], // Fecha de fin del evento
        'color' => '#28a745', // Color verde para las solicitudes aprobadas
        'extendedProps' => array(
            'Cod ticket' => $row['cod_ticket'],
            'Fecha prestamo' => $row['fecha_prestamo'],
            'Solicitante' => $row['solicitante'],
            'Aula solicitada' => $row['aula_solicitada'],
            'Cantidad' => $row['cantidad'],
            'Fecha inicial' => $row['fecha_inicial'],
            'Fecha final' => $row['fecha_final'],
            'Aprueba' => $row['aprueba'],
            'Estado' => $row['estado']
        )
    );

    // Agregar el evento al array de eventos
    array_push($eventos, $evento);
}

// Convertir el array de eventos a formato JSON
$eventosJson = json_encode($eventos);
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Calendario | ESFIM</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

            <!-- Nav Item - Calendario -->
            <li class="nav-item">
                <a class="nav-link" href="calendario.php">
                    <i class="fas fa-fw fa-calendar-day"></i>
                    <span>Calendario</span></a>
            </li>

            <!-- Nav Item - Tickets -->
            <li class="nav-item">
                <a class="nav-link" href="tickets.php">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Tickets</span></a>
            </li>

            <!-- Nav Item - Historial -->
            <li class="nav-item">
                <a class="nav-link" href="historial.php">
                    <i class="fas fa-fw fa-sitemap"></i>
                    <span>Historial</span></a>
            </li>

            <?php if ($rol == 1) { ?>
                <!-- Nav Item - Usuarios -->
                <?php if ($rol != 3) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="usuarios.php">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Usuarios</span></a>
                    </li>
                <?php } ?>
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

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre; ?></span>
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
                        <h1 class="h3 mb-0 text-gray-800">Calendario</h1>
                    </div>

                    <!-- Calendar Card -->
                    <div class="card mt-3 shadow p-3 mb-5 bg-body-tertiary rounded border-left-info">
                        <div id='calendar'></div>
                    </div>

                    <!-- Modal para mostrar detalles de la solicitud -->
                    <div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="solicitudModalLabel">Detalles de la Solicitud</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Aquí se mostrarán los detalles de la solicitud -->
                                    <div id="detalleSolicitud"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Script para inicializar el calendario y manejar clics en los eventos -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const calendarEl = document.getElementById('calendar');
                            const calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                events: <?php echo $eventosJson; ?>,
                                eventClick: function(info) {
                                    const extendedProps = info.event.extendedProps;
                                    let details = '<ul>';
                                    for (const [key, value] of Object.entries(extendedProps)) {
                                        details += `<li><strong>${key}:</strong> ${value}</li>`;
                                    }
                                    details += '</ul>';

                                    $('#detalleSolicitud').html(details);
                                    $('#solicitudModal').modal('show');
                                }
                            });
                            calendar.render();
                        });
                    </script>
                </div>
                <!-- /.container-fluid -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; División de Tecnologías de la Información y de las Comunicaciones ESFIM</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button -->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal -->
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

        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript -->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages -->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

</body>
</html>
