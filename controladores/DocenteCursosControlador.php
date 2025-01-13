<?php
require_once '../modelos/DocenteCursosModelo.php';
if ($_POST) {
    $usu = new DocentesCursos();
    switch ($_POST['accion']) {
        case "CONSULTAR_ID":
            $id_curso_docente = $_POST['IdDocente'];
            $id_periodo = $_POST['Periodo'];
            echo json_encode($usu->CargarCursos(
                $id_curso_docente,
                $id_periodo 
            ));
            break;
        case "CONSULTAR_DOCENTE":
            echo json_encode($usu->CargarDocente($_POST['DniDocente']));
            break;
        case "BUSCAR_CURSO_DOCENTE":
            echo json_encode($usu->BuscarCursoDocente($_POST['Curso_Docente']));
            break;
        case "CARGAR_ESTUDIANTES":
            $id_curso_docente = $_POST['id_curso_docente'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($usu->CargarMisEstudiantes(
                $id_curso_docente,
                $id_periodo
            ));
            break;
        case "LLENAR_PERIODO":
            echo json_encode($usu->CargarPeriodo());
            break;
        case "LLENAR_CURSOS_PERIODO":
            $i = $_POST['IdDocente'];
            $k = $_POST['Periodo'];
            echo json_encode($usu->CargarEnComboCursos($i, $k));
            break;
        case "LLENAR_COMPETENCIAS":
            echo json_encode($usu->CargarCompetencias());
            break;
        case "EDITAR_EVALUACION_CURSOS_DOCENTE":
            $id_curso_docente = $_POST['id_curso_docente'];
            $id_competencia_1 = $_POST['Competencia1'];
            $nombre_evaluacion1 = $_POST['NomEvaluacion1'];
            $id_competencia_2 = $_POST['Competencia2'];
            $nombre_evaluacion2 = $_POST['NomEvaluacion2'];
            $id_competencia_3 = $_POST['Competencia3'];
            $nombre_evaluacion3 = $_POST['NomEvaluacion3'];

            echo json_encode($usu->editar_evaluacion_cursos_docente(
                $id_curso_docente,
                $id_competencia_1,
                $nombre_evaluacion1,
                $id_competencia_2,
                $nombre_evaluacion2,
                $id_competencia_3,
                $nombre_evaluacion3
            ));
            break;


    }
}
