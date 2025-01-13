<?php
$idMantenimiento = isset($_GET['id_estudiante']) ? $_GET['id_estudiante'] : null;
require('./fpdf.php');

if ($idMantenimiento) {
    class PDF extends FPDF
    {

        // Cabecera de página
        function Header()
        {
            $this->Image('../../assets/images/logotexto.png', 155, 10, 45); // Logo de la empresa
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(48);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(50, 15, iconv("UTF-8", "ISO-8859-1", strtoupper("REPORTE DE CALIFICACIONES DE CURSOS Y MÓDULOS")), 1, 1, 'C', 0); // Título
            $this->Ln(7); // Salto de línea
            $this->SetTextColor(103);
        }

        // Pie de página
        function Footer()
        {
            $this->SetY(-15); // Posición: a 1,5 cm del final
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "Página") . $this->PageNo() . '/{nb}', 0, 0, 'C'); // Pie de página
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $hoy = date('d/m/Y');
            $this->Cell(520, 10, iconv("UTF-8", "ISO-8859-1", $hoy), 0, 0, 'C'); // Fecha de página
        }
    }

    // Consulta a la base de datos para obtener los datos del mantenimiento
    require '../../modelos/conexion.php';
    $conex = new Conexion();
    $stmt = $conex->prepare("select * from estudiante where id_estudiante =:id_estudiante;");


    $stmt->bindParam(':id_estudiante', $_GET['id_estudiante']); // Filtramos por el id de mantenimiento que se pasa por GET
    $stmt->execute();

    $pdf = new PDF();
    $pdf->AddPage("P", "A4"); // Agregar página en formato A4 (Vertical)
    $pdf->AliasNbPages(); // Muestra la página / y total de páginas

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetDrawColor(163, 163, 163); // Color del borde

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        // Sección de Técnico (con borde)
        $pdf->SetFillColor(200, 220, 255); // Establece el color de fondo (puedes cambiar estos valores)
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "TÉCNICO"), 1, 1, 'C', true); // Título de sección
        $pdf->SetFont('Arial', '', 12);

        // Usamos MultiCell para que el ancho se adapte al contenido y la altura se ajuste automáticamente
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "Nombres: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Apellidos: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);
        // Datos adicionales del mantenimiento en una segunda fila
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "Teléfono: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Especialidad: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "Correo: "), 1);
        $pdf->Cell(140, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);

        // Sección de Datos del Equipo (con borde)
        $pdf->SetFillColor(200, 220, 255); // Establece el color de fondo (puedes cambiar estos valores)
        $pdf->SetTextColor(0, 0, 0); // Establece el color del texto (puedes cambiar estos valores)
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "DATOS DEL EQUIPO"), 1, 1, 'C', true); // true activa el relleno
        $pdf->SetFont('Arial', '', 12);


        // Agrupar tres filas por columna
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "ID Equipo: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Descripción: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);

        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "Estado: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Generación: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);

        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "Sistema Operativo: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Código Patrimonial: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);

        // Sección de Mantenimiento (con borde)
        $pdf->SetFillColor(200, 220, 255); // Establece el color de fondo (puedes cambiar estos valores)
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "MANTENIMIENTO"), 1, 1, 'C', true); // Título de sección
        $pdf->SetFont('Arial', '', 12);

        // Usamos MultiCell para que el ancho se adapte al contenido y la altura se ajuste automáticamente
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "ID Mantenimiento: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Fecha: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);

        // Datos adicionales del mantenimiento en una segunda fila
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", "Tipo de Mantenimiento: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 0);
        $pdf->Cell(40, 10, iconv("UTF-8", "ISO-8859-1", "Estado: "), 1);
        $pdf->Cell(50, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 1);

        // Sección de Problema y Solución (con borde)
        $pdf->SetFillColor(200, 220, 255); // Establece el color de fondo (puedes cambiar estos valores)
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, iconv("UTF-8", "ISO-8859-1", "PROBLEMA Y SOLUCIÓN"), 1, 1, 'C', true);
        $pdf->SetFont('Arial', '', 12);

        // Aquí usamos MultiCell para ajustar automáticamente la altura
        $pdf->Cell(60, 10, iconv("UTF-8", "ISO-8859-1", "Descripción del Problema: "), 1);
        $pdf->MultiCell(130, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 'L');

        $pdf->Cell(60, 10, iconv("UTF-8", "ISO-8859-1", "Causa: "), 1);
        $pdf->MultiCell(130, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 'L');

        $pdf->Cell(60, 10, iconv("UTF-8", "ISO-8859-1", "Síntoma: "), 1);
        $pdf->MultiCell(130, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 'L');

        $pdf->Cell(60, 10, iconv("UTF-8", "ISO-8859-1", "Solución: "), 1);
        $pdf->MultiCell(130, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 'L');

        $pdf->Cell(60, 10, iconv("UTF-8", "ISO-8859-1", "Estado: "), 1);
        $pdf->MultiCell(130, 10, iconv("UTF-8", "ISO-8859-1", $row['dni']), 1, 'L');
    }

    $pdf->Output();
} else {
    echo 'No se encontró el ID de mantenimiento.';
}
?>