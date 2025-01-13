<?php
$dni = isset($_GET['dni']) ? (string) $_GET['dni'] : null;  // Convertir 'dni' a string
$id_año_escolar = isset($_GET['id_año_escolar']) ? (int) $_GET['id_año_escolar'] : null;  // Convertir 'id_año_escolar' a entero


if (empty($dni) || empty($id_año_escolar)) {
    die("Error: Los parámetros DNI o Año Escolar no tienen valores.");
}

require './fpdf.php';

class PDF extends FPDF
{
    function AddPhotos($fotoEstudiante, $fotoPadre, $fotoMadre)
    {
        // Asegúrate de que las rutas de las fotos no estén vacías
        if (!empty($fotoEstudiante)) {
            $this->Image($fotoEstudiante, 10, 20, 30, 40);  // Ajusta las posiciones y tamaños según sea necesario
        }

        if (!empty($fotoPadre)) {
            $this->Image($fotoPadre, 50, 20, 30, 40);  // Ajusta las posiciones y tamaños según sea necesario
        }

        if (!empty($fotoMadre)) {
            $this->Image($fotoMadre, 90, 20, 30, 40);  // Ajusta las posiciones y tamaños según sea necesario
        }
    }

    function Header()
    {
        $this->Image('../../assets/images/LogoAnexoHorizontal.png', 11, 6, 55);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(40);
        $this->Ln(20);
        $this->SetTextColor(103);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, "Este documento no tiene valor sin los sellos y las firmas oficiales de la Institución", 0, 0, 'C');
        $hoy = date('d/m/Y');
        $this->Cell(520, 10, $hoy, 0, 0, 'C');
    }
}

require '../../modelos/conexion.php';


$conex = new Conexion();
// Asegúrate de establecer la codificación UTF-8 en la conexión MySQL
$conex->exec("SET NAMES 'utf8mb4'");


// Consulta principal para estudiante y matrícula   
$stmt = $conex->prepare("SELECT u.dni, u.apellido_paterno, u.apellido_materno, u.nombres, u.fecha_nacimiento, u.distrito_nacimiento, u.provincia_nacimiento, u.departamento_nacimiento, u.sexo, u.nacionalidad, u.idioma, u.contra, u.tipo_usuario, dn.name AS distrito_nacimiento1, pn.name AS provincia_nacimiento1, dpn.name AS departamento_nacimiento1 FROM usuario u LEFT JOIN ubigeo_peru_districts dn ON u.distrito_nacimiento = dn.id LEFT JOIN ubigeo_peru_provinces pn ON u.provincia_nacimiento = pn.id LEFT JOIN ubigeo_peru_departments dpn ON u.departamento_nacimiento = dpn.id WHERE u.dni = ?;");

$stmt->bindParam(1, $dni, PDO::PARAM_INT);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $datos = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("No se encontraron datos para el DNI proporcionado.");
}
$stmtFiltro = $conex->prepare("select id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC LIMIT 1;");
$stmtFiltro->execute();

$filtro = $stmtFiltro->fetch(PDO::FETCH_ASSOC);
$mostrador = $filtro["id_año_escolar"];

$stmtFamiliares = $conex->prepare("SELECT 
    nombre_completo, edad, actividad, lugar, grado_estudio
FROM 
    Familiares
WHERE 
    dni = ? AND id_año_escolar = ?;");


// Enlazar los parámetros
$stmtFamiliares->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtFamiliares->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)

$stmtFamiliares->execute();

// Recuperar los resultados
if ($stmtFamiliares->rowCount() > 0) {
    $familiares = $stmtFamiliares->fetchAll(PDO::FETCH_ASSOC);
} else {
    $familiares = [];
}

$stmtPadres = $conex->prepare("SELECT 
                nombre_completo, correo, telefono, nacionalidad, direccion,vive_con_hijo,documento,grado_instruccion,profesion,centro_trabajo, foto_padre,tipo_parentesco,condicion_padres,fecha_nacimiento_padre,distrito_nacimiento
FROM 
    Padres
WHERE dni = ? AND id_año_escolar = ?;");
$stmtPadres->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtPadres->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtPadres->execute();

$padres = $stmtPadres->fetchAll(PDO::FETCH_ASSOC);

$padre = null;
$madre = null;

foreach ($padres as $padre_madre) {
    if ($padre_madre['tipo_parentesco'] == 'Padre') {
        $padre = $padre_madre;
    } elseif ($padre_madre['tipo_parentesco'] == 'Madre') {
        $madre = $padre_madre;
    }
}


$stmtPadres13 = $conex->prepare("SELECT ex_alumno, año_egreso, nombre_ie, tipo_parentesco,trajabador_ipnm FROM Padres  WHERE dni = ? AND id_año_escolar = ?;");
$stmtPadres13->bindParam(1, $dni, PDO::PARAM_STR);  
$stmtPadres13->bindParam(2, $id_año_escolar, PDO::PARAM_INT);
$stmtPadres13->execute();
$resultadoPadres2 = $stmtPadres13->fetchAll(PDO::FETCH_ASSOC);

// Inicializar las variables para el padre y la madre
$exAlumnoPadre = $añoEgresoPadre = $nombreIEPadre = null;
$exAlumnoMadre = $añoEgresoMadre = $nombreIEMadre = null;


foreach ($resultadoPadres2 as $registroPadre) {
    if ($registroPadre['tipo_parentesco'] == 'Padre') {
        $exAlumnoPadre = $registroPadre['ex_alumno'] ?? null;
        $pPadre = $registroPadre['tipo_parentesco'] ?? null;
        $añoEgresoPadre = $registroPadre['año_egreso'] ?? null;
        $nombreIEPadre = $registroPadre['nombre_ie'] ?? null;
        $tP = $registroPadre['trajabador_ipnm'] ?? null;
    } elseif ($registroPadre['tipo_parentesco'] == 'Madre') {
        $exAlumnoMadre = $registroPadre['ex_alumno'] ?? null;
        $pMadre = $registroPadre['tipo_parentesco'] ?? null;
        $añoEgresoMadre = $registroPadre['año_egreso'] ?? null;
        $nombreIEMadre = $registroPadre['nombre_ie'] ?? null;
        $tM = $registroPadre['trajabador_ipnm'] ?? null;
    }
}


$stmtEmer = $conex->prepare("SELECT 
        ROW_NUMBER() OVER (ORDER BY nombre_contacto) AS numero_orden,
        dni, id_año_escolar, nombre_contacto, numero_contacto, parentesco_contacto
    FROM 
        Emergencias 
WHERE dni = ? AND id_año_escolar = ?;");
$stmtEmer->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtEmer->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtEmer->execute();
$emer = $stmtEmer->fetchAll(PDO::FETCH_ASSOC);


// Consulta para obtener los sacramentos
$stmtSacramentos = $conex->prepare("SELECT 
                *
            FROM 
                Sacramentos
          WHERE dni = ? AND id_año_escolar = ?;");
$stmtSacramentos->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtSacramentos->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtSacramentos->execute();
$sacramentos = $stmtSacramentos->fetch(PDO::FETCH_ASSOC);

// Consulta para obtener la residencia
$stmtGrados = $conex->prepare("SELECT 
                g1.grado AS grado_actual,
                g2.grado AS siguiente_grado
            FROM 
                residencia r
            JOIN 
                grado_academico g1 ON r.id_grado_estudiante = g1.id_grado_academico
            LEFT JOIN 
                grado_academico g2 ON g2.id_grado_academico = g1.id_grado_academico + 1
                   WHERE r.dni = ? AND r    .id_año_escolar = ?;");
$stmtGrados->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtGrados->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtGrados->execute();

$grados = $stmtGrados->fetch(PDO::FETCH_ASSOC);

// Consulta para obtener la residencia
$stmtResidencia = $conex->prepare("SELECT 
                id_residencia, distrito_domicilio, urb_domicilio, calle_domicilio, num_domicilio, telefono_padre, telefono_madre, alergias, enfermedades_cronicas,imagen_estudiante
            FROM 
                residencia
WHERE dni = ? AND id_año_escolar = ?;");
$stmtResidencia->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtResidencia->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtResidencia->execute();
$residencia = $stmtResidencia->fetch(PDO::FETCH_ASSOC);

$fotoEstudiante = $residencia['imagen_estudiante'];
if ($fotoEstudiante) {
    file_put_contents('ruta_temp_estudiante.jpg', $fotoEstudiante);
}
// Consulta para obtener solo los 4 campos solicitados
$stmtFML = $conex->prepare("SELECT 
            f.nombre_completo,
            f.ex_alumno,
            f.grado_colegio,
            f.año_egreso,
            ga.grado,
            f.estudiante_perteneciente
        FROM 
            familiares f
        JOIN 
            grado_academico ga ON f.grado_colegio = ga.id_grado_academico
WHERE f.dni = ? AND f.id_año_escolar = ?;");
$stmtFML->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtFML->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtFML->execute();

// Recuperamos los datos
$SagradaFamiliar = $stmtFML->fetchAll(PDO::FETCH_ASSOC);


$stmtCantidadH = $conex->prepare("select 
            COUNT(*) AS hermanos, 
            COUNT(*) + 1 AS total_hermanos,
            COUNT(CASE WHEN f.estudiante_perteneciente = 'Si' THEN 1 END) AS hermanos_perteneciente
        FROM 
            Familiares f
        WHERE f.dni = ? AND f.id_año_escolar = ?;");
$stmtCantidadH->bindParam(1, $dni, PDO::PARAM_STR);  // Aseguramos que 'dni' sea tratado como texto (cadena)
$stmtCantidadH->bindParam(2, $id_año_escolar, PDO::PARAM_INT);  // Aseguramos que 'id_año_escolar' sea tratado como número entero (int)
$stmtCantidadH->execute();

// Recuperamos los datos
$cantidah = $stmtCantidadH->fetch(PDO::FETCH_ASSOC);
// Crear el objeto PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetXY(165, 15);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, utf8_decode("GRADO:"), 1, 1, 'C');
$pdf->SetXY(165, 23);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 8, utf8_decode($grados['grado_actual']), 1, 1, 'C');
$pdf->Ln(10);



/// Posición vertical de las fotos
$posY = 35;

// Mostrar un cuadro vacío para el padre
$pdf->SetXY(50, $posY);
$pdf->Cell(30, 40, 'No Foto del Padre', 1, 0, 'C'); // Cuadro vacío con la leyenda "Foto del Padre"

// Mostrar un cuadro vacío para la madre
$pdf->SetXY(130, $posY);
$pdf->Cell(30, 40, 'No Foto de la Madre', 1, 0, 'C'); // Cuadro vacío con la leyenda "Foto de la Madre"



$pdf->SetXY(90, $posY);
$pdf->Cell(30, 40, 'No Foto', 1, 0, 'C');


$pdf->Ln(45); // Deja espacio para los datos debajo de las fotos

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(55, 8, "I. DATOS DEL EDUCANDO", 1, 1, 'A');  // Título "SACRAMENTOS"
$pdf->Ln(2);
// Información del Estudiante en 3 columnas
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 6, "Apellido paterno", 1, 0, 'C');
$pdf->Cell(60, 6, "Apellido materno", 1, 0, 'C');
$pdf->Cell(65, 6, "Nombre completo", 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 6, utf8_decode($datos['apellido_paterno']), 1, 0, 'C');
$pdf->Cell(60, 6, utf8_decode($datos['apellido_materno']), 1, 0, 'C');
$pdf->Cell(65, 6, utf8_decode($datos['nombres']), 1, 1, 'C');

$pdf->Ln(4); // Espacio entre secciones6
// Información adicional
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(45, 6, "NACIMIENTO", 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(18, 6, utf8_decode("Distrito"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(52, 6, utf8_decode($datos['distrito_nacimiento']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, utf8_decode("Dpto."), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 6, utf8_decode($datos['departamento_nacimiento']), 1, 1, 'L');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(45, 6, utf8_decode($datos['fecha_nacimiento']), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(18, 6, utf8_decode("Provincia"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(52, 6, utf8_decode($datos['provincia_nacimiento']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, utf8_decode("Idioma"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 6, utf8_decode($datos['idioma']), 1, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(20, 6, utf8_decode("Sexo"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 6, utf8_decode($datos['sexo']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, utf8_decode("Nacionalidad"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 6, utf8_decode($datos['nacionalidad']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, utf8_decode("DNI/CE N°"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 6, utf8_decode($datos['dni']), 1, 1, 'L');

$pdf->Ln(4); // Espacio entre secciones

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(185, 6, "DOMICILIO", 1, 1, 'A');  // Título "SACRAMENTOS"
$pdf->SetFont('Arial', '', 10);
// Información adicional
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 6, "Distrito", 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode("Urbanización"), 1, 0, 'C');
$pdf->Cell(45, 6, "Calle/Av. pasaje", 1, 0, 'C');
$pdf->Cell(45, 6, "Nro. Dpto./Int.", 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 6, utf8_decode($residencia['distrito_domicilio']), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode($residencia['urb_domicilio']), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode($residencia['calle_domicilio']), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode($residencia['num_domicilio']), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(46, 6, utf8_decode("Teléfono padre"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(49, 6, utf8_decode($residencia['telefono_padre']), 1, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(45, 6, utf8_decode("Teléfono madre"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(45, 6, utf8_decode($residencia['telefono_madre']), 1, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(46, 6, utf8_decode("Alergías"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(139, 6, utf8_decode($residencia['alergias']), 1, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(46, 6, utf8_decode("Enfermedades crónicas"), 1, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(139, 6, utf8_decode($residencia['enfermedades_cronicas']), 1, 1, 'L');

// Espaciado para sacramentos
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(185, 6, "SACRAMENTOS", 1, 1, 'A');  // Título "SACRAMENTOS"
$pdf->SetFont('Arial', '', 10);
// Mostrar sacramentos en columnas con tamaños personalizados
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 6, utf8_decode("¿Bautizado?"), 1, 0, 'A');  // Título "Bautizado" con tamaño de celda
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(20, 6, utf8_decode($sacramentos['bautizado']), 1, 0, 'C');  // Valor de "Bautizado"
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(65, 6, utf8_decode("Parroquia donde se bautizó y distrito"), 1, 0, 'A');  // Título "Bautizado" con tamaño de celda
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(65, 6, utf8_decode($sacramentos['parroquia_bautizo']), 1, 1, 'C');  // Valor de "Bautizado"
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(70, 6, utf8_decode("Primera comunión"), 1, 0, 'A');  // Título "Primera Comunión"
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(20, 6, utf8_decode($sacramentos['primera_comunion']), 1, 0, 'C');  // Valor de "Primera Comunión"
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(45, 6, utf8_decode("Confirmación"), 1, 0, 'A');  // Título "Confirmación"
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 6, utf8_decode($sacramentos['confirmacion']), 1, 1, 'C');  // Valor de "Confirmación"
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, utf8_decode("¿Asísten a mísa los domingos?"), 1, 0, 'A');  // Título "Primera Comunión"
$pdf->SetFont('Arial', '', 10);

$pdf->Cell(20, 6, utf8_decode($sacramentos['asistencia_misa']), 1, 0, 'C');  // Valor de "Primera Comunión"
$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(45, 6, utf8_decode("Parroquia donde asiste:"), 1, 0, 'A');  // Título "Confirmación"
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 6, utf8_decode($sacramentos['parroquia_misa']), 1, 1, 'C');  // Valor de "Confirmación"


// Datos Familiares
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(185, 6, "DATOS FAMILIARES", 1, 1, 'A');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(45, 6, "Nombre", 1, 0, 'C');
$pdf->Cell(20, 6, "Edad", 1, 0, 'C');
$pdf->Cell(45, 6, "Actividad", 1, 0, 'C');
$pdf->Cell(30, 6, "Lugar", 1, 0, 'C');
$pdf->Cell(45, 6, "Grado de estudios", 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

// Ahora, recorres los datos familiares y los muestras de la misma forma
foreach ($familiares as $familiar) {
    $pdf->Cell(45, 5, utf8_decode($familiar['nombre_completo']), 1, 0, 'C');
    $pdf->Cell(20, 5, utf8_decode($familiar['edad']), 1, 0, 'C');
    $pdf->Cell(45, 5, utf8_decode($familiar['actividad']), 1, 0, 'C');
    $pdf->Cell(30, 5, utf8_decode($familiar['lugar']), 1, 0, 'C');
    $pdf->Cell(45, 5, utf8_decode($familiar['grado_estudio']), 1, 1, 'C');
}

// Datos Familiares
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(185, 6, utf8_decode("FAMILIARIDAD CON SAGRADO CORAZÓN"), 1, 1, 'A');
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 6, utf8_decode(""), 1, 0, 'C');
$pdf->Cell(60, 6, utf8_decode("¿Es exalumno/a Sagrado Corazón?"), 1, 0, 'C');

$pdf->Cell(45, 6, utf8_decode("Año en que culminó estudios"), 1, 0, 'C');

$pdf->Cell(35, 6, utf8_decode("Nombre del colegio o I.E"), 1, 0, 'C');
$pdf->Cell(30, 6, utf8_decode("Trabajador del IPNM"), 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15, 5, utf8_decode($pPadre ?? ''), 1, 0, 'C');
$pdf->Cell(60, 5, utf8_decode($exAlumnoPadre ?? ''), 1, 0, 'C');
$pdf->Cell(45, 5, utf8_decode($añoEgresoPadre ?? ''), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode($nombreIEPadre ?? ''), 1, 0, 'C');
$pdf->Cell(30, 5, utf8_decode($tP ?? ''), 1, 1, 'C');

$pdf->Cell(15, 5, utf8_decode($pMadre ?? ''), 1, 0, 'C');
$pdf->Cell(60, 5, utf8_decode($exAlumnoMadre ?? ''), 1, 0, 'C');
$pdf->Cell(45, 5, utf8_decode($añoEgresoMadre ?? ''), 1, 0, 'C');
$pdf->Cell(35, 5, utf8_decode($nombreIEMadre ?? ''), 1, 0, 'C');
$pdf->Cell(30, 5, utf8_decode($tM ?? ''), 1, 1, 'C');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 6, utf8_decode("N° hermanos"), 1, 0, 'C');
$pdf->Cell(20, 6, utf8_decode($cantidah['hermanos_perteneciente']), 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode("¿Estudia en este colegio?"), 1, 0, 'C');
$pdf->Cell(45, 6, utf8_decode("¿En qué grado?"), 1, 0, 'C');

$pdf->Cell(30, 6, utf8_decode("¿Es exalumno?"), 1, 0, 'C');
$pdf->Cell(30, 6, utf8_decode("Año en que terminó"), 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
foreach ($SagradaFamiliar as $SagradaFamiliar) {
    $pdf->Cell(40, 5, utf8_decode($SagradaFamiliar['nombre_completo']), 1, 0, 'C');
    $pdf->Cell(40, 5, utf8_decode($SagradaFamiliar['estudiante_perteneciente']), 1, 0, 'C');
    $pdf->Cell(45, 5, utf8_decode($SagradaFamiliar['grado']), 1, 0, 'C');
    $pdf->Cell(30, 5, utf8_decode($SagradaFamiliar['ex_alumno']), 1, 0, 'C');
    $pdf->Cell(30, 5, utf8_decode($SagradaFamiliar['año_egreso']), 1, 1, 'C');
}



// Información de los Padres
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(62, 8, utf8_decode("II. INFORMACIÓN DE LOS PADRES"), 1, 1, 'A');
$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 6, "DATOS", 1, 0, 'C');
$pdf->Cell(135, 6, utf8_decode(strtoupper($padre ? $padre['tipo_parentesco'] : '')), 1, 1, 'C');

// Información del Padre
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 5, "Nombre Completo", 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['nombre_completo'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, "Correo", 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['correo'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Teléfono"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['telefono'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Lugar y fecha de nacimiento"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['distrito_nacimiento'] . '    ' . $padre['fecha_nacimiento_padre'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Dirección"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['direccion'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("¿Vive con su hijo(a)?"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['vive_con_hijo'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Nacionalidad"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['nacionalidad'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("DNI/C.E/C.I Nro."), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['documento'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("GRADO DE INSTRUCCIÓN"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['grado_instruccion'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("PROFESIÓN"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['profesion'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("CENTRO DE TRABAJO"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($padre ? $padre['centro_trabajo'] : ''), 1, 1, 'L');
// Información de la Madre
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 6, "DATOS", 1, 0, 'C');
$pdf->Cell(135, 6, utf8_decode(strtoupper($madre ? $madre['tipo_parentesco'] : '')), 1, 1, 'C');

// Información de la Madre
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 5, "Nombre Completo", 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['nombre_completo'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, "Correo", 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['correo'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Teléfono"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['telefono'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Lugar y fecha de nacimiento"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['distrito_nacimiento'] . '    ' . $madre['fecha_nacimiento_padre'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Dirección"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['direccion'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("¿Vive con su hijo(a)?"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['vive_con_hijo'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("Nacionalidad"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['nacionalidad'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("DNI/C.E/C.I Nro."), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['documento'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("GRADO DE INSTRUCCIÓN"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['grado_instruccion'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("PROFESIÓN"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['profesion'] : ''), 1, 1, 'L');

$pdf->Cell(50, 5, utf8_decode("CENTRO DE TRABAJO"), 1, 0, 'L');
$pdf->Cell(135, 5, utf8_decode($madre ? $madre['centro_trabajo'] : ''), 1, 1, 'L');


$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetX(50);
$pdf->Cell(100, 6, utf8_decode("CONDICIÓN DE LOS PADRES"), 1, 1, 'C');
$pdf->SetX(50);

// Condición de los Padres
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, utf8_decode(strtoupper($padre ? $padre['tipo_parentesco'] : '')), 1, 0, 'L');
$pdf->Cell(75, 6, utf8_decode($padre ? $padre['condicion_padres'] : ''), 1, 1, 'L');
$pdf->SetX(50);
$pdf->Cell(25, 6, utf8_decode(strtoupper($madre ? $madre['tipo_parentesco'] : '')), 1, 0, 'L');
$pdf->Cell(75, 6, utf8_decode($madre ? $madre['condicion_padres'] : ''), 1, 1, 'L');
// Continuar con emergencias si es necesario
// Datos Familiares
$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(185, 6, utf8_decode("TELÉFONOS DE EMERGENCIA(DE NO ENCONTRAR A PAPÁ O MAMÁ A QUIÉN LLAMAMOS)"), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(18, 6, utf8_decode("N°"), 1, 0, 'C');
$pdf->Cell(90, 6, "Nombre", 1, 0, 'C');
$pdf->Cell(32, 6, utf8_decode("Número"), 1, 0, 'C');
$pdf->Cell(45, 6, "Parentesco", 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);

// Ahora, recorres los datos familiares y los muestras de la misma forma
foreach ($emer as $emer) {
    $pdf->Cell(18, 6, utf8_decode($emer['numero_orden']), 1, 0, 'C');
    $pdf->Cell(90, 6, utf8_decode($emer['nombre_contacto']), 1, 0, 'C');
    $pdf->Cell(32, 6, utf8_decode($emer['numero_contacto']), 1, 0, 'C');
    $pdf->Cell(45, 6, utf8_decode($emer['parentesco_contacto']), 1, 1, 'C');
}

// Información del Estudiante en 3 columnas

$pdf->Ln(6);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 8, utf8_decode("La presente ficha tiene carácter de declaración jurada"), 0, 1, 'A');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(93, 12, utf8_decode(""), 1, 0, 'C');
$pdf->Cell(92, 12, utf8_decode(""), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(93, 6, "Firma Madre", 1, 0, 'C');
$pdf->Cell(92, 6, "Firma Padre", 1, 1, 'C');
$pdf->Output();

?>