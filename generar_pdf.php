<?php
// Incluir la biblioteca TCPDF
require_once('./vendor/tcpdf/examples/tcpdf_include.php');

// Crear una nueva instancia de TCPDF con formato horizontal
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nombre del Autor');
$pdf->SetTitle('Título del PDF');
$pdf->SetSubject('Sujeto del PDF');
$pdf->SetKeywords('TCPDF, PDF, ejemplo, prueba');

// Agregar una página
$pdf->AddPage();

// Conectar a la base de datos y recuperar los registros de la tabla historial
$mysqli = new mysqli('15.235.86.58', 'esfimedu_luis', 'k%-eDD4n3xDz', 'esfimedu_db_das_esfim');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM historial";
$result = $conn->query($sql);

// Crear una tabla HTML para mostrar los registros
$html = '<h1 style="font-family: Nunito, sans-serif;">Historial de Prestamos</h1>';
$html .= '<table border="1" cellpadding="5" style="font-family: Nunito, sans-serif; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #d3d3d3; font-weight: bold;">
                    <th>ID</th>
                    <th>Código de Ticket</th>
                    <th>Fecha de Prestamo</th>
                    <th>Solicitante</th>
                    <th>Aula Solicitada</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Termino</th>
                    <th>Validador</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['ID'] . '</td>';
        $html .= '<td>' . $row['cod_ticket'] . '</td>';
        $html .= '<td>' . $row['fecha_prestamo'] . '</td>';
        $html .= '<td>' . $row['solicitante'] . '</td>';
        $html .= '<td>' . $row['aula_solicitada'] . '</td>';
        $html .= '<td>' . $row['fecha_inicial'] . '</td>';
        $html .= '<td>' . $row['fecha_final'] . '</td>';
        $html .= '<td>' . $row['aprueba'] . '</td>';
        $html .= '<td>' . $row['estado'] . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="9">No hay registros en la tabla historial</td></tr>';
}

$html .= '</tbody>
        </table>';

// Agregar el contenido al PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar la conexión a la base de datos
$conn->close();

// Generar el PDF y mostrarlo en el navegador
$pdf->Output('historial.pdf', 'I');
