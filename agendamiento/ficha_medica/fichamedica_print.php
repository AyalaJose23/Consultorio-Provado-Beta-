<?php

// Incluir las librerías TCPDF y la clase de conexión (ajusta las rutas según tu estructura)
require '../../librerias/tcpdf/tcpdf.php';
require '../../conexion.php';

// Obtener parámetros de filtro
$cod_pacientes = isset($_GET['vcod_pacientes']) ? $_GET['vcod_pacientes'] : 0;
$cod_doctor = isset($_GET['vcod_doctor']) ? $_GET['vcod_doctor'] : null;

class MYPDF extends TCPDF {

    public function Header() {
        // Agregar encabezado si es necesario (puedes colocar aquí el logo y la información del consultorio)
    }

    public function Footer() {
        // Agregar pie de página si es necesario (puedes mantener esta parte si no la necesitas)
    }

}

// Crear instancia de TCPDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configurar información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nombre del Doctor o Consultorio');
$pdf->SetTitle('FICHA MÉDICA');
$pdf->SetSubject('Prototipo de Impresión para Ficha Médica');
$pdf->SetKeywords('TCPDF, PDF, ficha médica, informe médico');

// Configuración de márgenes y saltos de página
$pdf->SetMargins(20, 20, 20);
$pdf->SetFooterMargin(15);
$pdf->SetAutoPageBreak(TRUE, 15);

// Agregar página y logo del consultorio
$pdf->AddPage('P', 'A4');
$pdf->Image("img/logoconsultorio.png", 15, 15, 60, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

// Campos de Datos del Consultorio
$pdf->SetFont('times', 'B', 12);
$pdf->SetXY(80, 15);
$pdf->Cell(0, 10, 'CONSULTORIO MÉDICO "CENTRO MÉDICO VIDA Y AMOR"', 0, 1, 'L');
$pdf->SetX(80);
$pdf->Cell(0, 10, 'Dirección: Ruta n°8 - Simón Bolívar', 0, 1, 'L');
$pdf->SetX(80);
$pdf->Cell(0, 10, 'Teléfono: 0975388433', 0, 1, 'L');
$pdf->SetX(80);
$pdf->Cell(0, 10, 'Correo: centroamoryvida@gmail.com', 0, 1, 'L');
$pdf->SetXY(80, 60); // Ajusta la posición según tu diseño

// Agregar título
$pdf->SetFont('times', 'B', 16);
$pdf->SetXY(30, 70);
$pdf->Cell(0, 20, 'FICHA MÉDICA', 0, 1, 'C');

// Establecer el tamaño de fuente a 14 puntos
$pdf->SetFont('times', '', 14);

// Construir la consulta SQL
$sql = "SELECT * FROM v_fichamedica WHERE cod_ficha = $cod_pacientes";
if ($cod_doctor) {
    $sql .= " AND cod_doctor = $cod_doctor";
}

// Obtener datos de la consulta solo para el paciente y filtros seleccionados
$cabeceras = consultas::get_datos($sql);

// Verificar si existen registros para el paciente
if (!empty($cabeceras)) {
    $pdf->SetFont('times', 'B', 14);
    $pdf->Cell(0, 15, 'DATOS DEL PACIENTE', 0, 1, 'C');
    
    foreach ($cabeceras as $cabecera) {
        $pdf->SetFont('times', '', 12);
        $pdf->Cell(0, 10, "Paciente: " . $cabecera['paciente'], 0, 1, 'L');
        $pdf->Cell(0, 10, "CI: " . $cabecera['per_ci'], 0, 1, 'L');
        $pdf->Cell(0, 10, "Fecha de Nacimiento: " . $cabecera['per_fnac'], 0, 1, 'L');
        $pdf->Cell(0, 10, "Género: " . $cabecera['per_sexo'], 0, 1, 'L');
        $pdf->Ln();
        
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(0, 15, 'DETALLES DE FICHA MÉDICA', 0, 1, 'C');
        
        $detalles = consultas::get_datos("SELECT * FROM v_fichamedicaimpresion WHERE cod_ficha = " . $cabecera['cod_ficha']);
        
        if (!empty($detalles)) {
            foreach ($detalles as $detalle) {
                $pdf->SetFont('times', '', 12);
                $pdf->MultiCell(0, 10, 'Patología: ' . $detalle['pat_descri'], 0, 'L', false, 1);
                $pdf->MultiCell(0, 10, 'Alergia: ' . $detalle['descrip_aler'], 0, 'L', false, 1);
                $pdf->MultiCell(0, 10, 'Síntomas: ' . $detalle['sintomas_aler'], 0, 'L', false, 1);
                $pdf->MultiCell(0, 10, 'Causa: ' . $detalle['causa_aler'], 0, 'L', false, 1);
                $pdf->MultiCell(0, 10, 'Antecedentes Enfermedades: ' . $detalle['fich_antecedentes_enfermedades'], 0, 'L', false, 1);
                $pdf->MultiCell(0, 10, 'Cirugías Anteriores: ' . $detalle['fich_cirugias_anteriores'], 0, 'L', false, 1);
                $pdf->MultiCell(0, 10, 'Observaciones: ' . $detalle['fich_observacion'], 0, 'L', false, 1);
                $pdf->Ln();
            }
        } else {
            $pdf->Cell(0, 10, 'No se encontraron detalles de la ficha.', 0, 1, 'L');
        }
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No se encontraron datos para esta ficha.', 0, 1, 'L');
}

// Generar el archivo PDF
$pdf->Output('reporte_fichamedica.pdf', 'I');
?>
