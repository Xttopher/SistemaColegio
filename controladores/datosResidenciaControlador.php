<?php
require_once '../modelos/datosResidenciaModelo.php';
if ($_POST) {
    $drResidencia = new DtResidencia();
    switch ($_POST['accion']) {
        case "CONSULTAR_DT":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($drResidencia->CargarDatoID($dni, $id_periodo));
            break;

        case "LLENAR_PERIODO":
            echo json_encode($drResidencia->CargarPeriodo());
            break;
        case "LLENAR_GRADO":
            echo json_encode($drResidencia->CargarGradosAcademicos());
            break;
        case "NUEVO_RESIDENCIA":
            if (isset($_FILES['imagen_estudiante'])) {
                $file = $_FILES['imagen_estudiante'];
                if ($file['size'] > 2 * 1024 * 1024) { // Tamaño máximo: 2MB
                    echo json_encode("La imagen excede el tamaño permitido (2MB).");
                    exit;
                }
                if (!in_array($file['type'], ['image/jpeg', 'image/png'])) { // Tipos permitidos
                    echo json_encode("Formato de imagen no válido. Solo se permiten JPEG y PNG.");
                    exit;
                }
            }
            $dni = $_POST['dniAlumno'];
            $id_periodo = $_POST['añoacademico8'];
            $distrito_domicilio = $_POST['distrito_domicilio'];  // Se obtiene el distrito de la residencia
            $urb_domicilio = $_POST['urb_domicilio'];            // Se obtiene la urbanización
            $calle_domicilio = $_POST['calle_domicilio'];        // Se obtiene la calle
            $num_domicilio = $_POST['num_domicilio'];            // Se obtiene el número de la casa
            $telefono_padre = $_POST['telefono_padre'];          // Se obtiene el teléfono del padre
            $telefono_madre = $_POST['telefono_madre'];          // Se obtiene el teléfono de la madre
            $alergias = $_POST['alergias'];                      // Se obtienen las alergias
            $enfermedades_cronicas = $_POST['enfermedades_cronicas'];  // Se obtienen las enfermedades crónicas
            $imagen_estudiante = isset($_FILES['imagen_estudiante']['tmp_name']) ? file_get_contents($_FILES['imagen_estudiante']['tmp_name']) : NULL;
            $grado_academicoR = $_POST['grado_academicoR'];  // Se obtienen las enfermedades crónicas
            echo json_encode($drResidencia->registrar_Residencia(
                $dni,
                $id_periodo,
                $distrito_domicilio,
                $urb_domicilio,
                $calle_domicilio,
                $num_domicilio,
                $telefono_padre,
                $telefono_madre,
                $alergias,
                $enfermedades_cronicas,
                $imagen_estudiante,
                $grado_academicoR
            ));
            break;

        case "EDITAR":
            $id_sacramento = $_POST['id_sacramento'];
            $id_matricula = $_POST['id_matricula'];
            $bautizado = $_POST['bautizado'];
            $parroquia_bautizo = $_POST['parroquia_bautizo'];
            $primera_comunion = $_POST['primera_comunion'];
            $confirmacion = $_POST['confirmacion'];
            $asistencia_misa = $_POST['asistencia_misa'];
            $parroquia_misa = $_POST['parroquia_misa'];
            echo json_encode($drResidencia->editar_Sacramentos($id_sacramento, $id_matricula, $bautizado, $parroquia_bautizo, $primera_comunion, $confirmacion, $asistencia_misa, $parroquia_misa));
            break;
    }

}
