<?php
require_once '../modelos/adminGestorModelo.php';
if ($_POST) {
    $Gestor = new Gestor();
    switch ($_POST['accion']) {
        /*case "LLENAR_DOCENTES":
            echo json_encode($usu->listar_docentes());
            break;
         case "LLENAR_PROGRAMAS":
            echo json_encode($usu->listar_programas());
            break;
        case "LLENAR_CICLOS":
            echo json_encode($usu->listar_ciclos());
            break;
        case "LLENAR_PERIODO":
            echo json_encode($usu->CargarPeriodo());
            break;    
                case "LLENAR_CURSOS":
            $i = $_POST['Programa'];
            $k = $_POST['Ciclo'];
            echo json_encode($usu->listar_cursos($i, $k));
            break;
        case "AGREGAR_CURSO_DOCENTE":
            $a = $_POST['id_docente'];
            $b = $_POST['id_curso'];
            $c = $_POST['id_periodo'];
            echo json_encode($usu->agregar_curso_docente($b, $a, $c));
            break;    
            */
        case "LLENAR_ESTUDIANTES":
            echo json_encode($Gestor->listar_estudiantes());
            break;
        case "LLENAR_MATRICULADOS":
            $añoescolar = $_POST['Añoescolar'];  // Año Escolar
            $grado = $_POST['Grado'];
            echo json_encode($Gestor->listar_matriculados($añoescolar, $grado));
            break;
        case "LLENAR_FECHA_ESCOLAR":
            echo json_encode($Gestor->CargarFechaEscolar());
            break;
        case "LLENAR_GRADOS":
            echo json_encode($Gestor->CargarGradosAcademicos());
            break;
        case "NUEVO":
            $a = $_POST['nombre'];
            $b = $_POST['apellido_paterno'];
            $c = $_POST['apellido_materno'];
            $d = $_POST['dni'];
            $e = $_POST['usuario'];
            $f = md5($_POST['contrasena']);
            $g = $_POST['direccion'];
            $h = $_POST['email'];
            $i = $_POST['telefono'];
            $j = $_POST['fnaci'];
            echo json_encode($Gestor->agregar_usuarios($d, $e, $f, $a, $b, $c, $g, $h, $j, $i));
            break;

        case "CONSULTAR_ID":
            echo json_encode($Gestor->ConsultarPorId($_POST['IdUsuario']));
            break;
        case "CONSULTAR_ALUMNO":
            echo json_encode($Gestor->ConsultarEstudiante($_POST['DniEstudiante']));
            break;

        case "MODIFICAR":
            $a = $_POST['nombre'];
            $b = $_POST['apellido_paterno'];
            $c = $_POST['apellido_materno'];
            $d = $_POST['dni'];
            $e = $_POST['usuario'];
            $f = md5($_POST['contrasena']);
            $g = $_POST['direccion'];
            $h = $_POST['email'];
            $i = $_POST['telefono'];
            $j = $_POST['fnaci'];
            $k = $_POST['tipo_usuario'];
            echo json_encode($Gestor->editar_usuarios($d, $e, $f, $a, $b, $c, $g, $h, $j, $i, $k));
            break;
    }
}
