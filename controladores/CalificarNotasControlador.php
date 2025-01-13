<?php
require_once '../modelos/calificarEstudiante.php';
if ($_POST) {
    $usu = new CalificarNotas();
    switch ($_POST['accion']) {
        case "AGREGAR_NOTAS_ESTUDIANTES":
            $id_matricula = $_POST['id_matricula'];
            $id_curso_docente = $_POST['id_curso_docente'];
            $id_nivel_1 = $_POST['nota1'];
            $id_nivel_2 = $_POST['nota2'];
            $nota_final_1 = $_POST['notafinal1'];
            $comentario = $_POST['comentario'];
            $nota_final_2 = $_POST['notafinal2'];
            $comentario2 = $_POST['comentario2'];
            $id_nivel_3 = $_POST['nota3'];
            $id_nivel_4 = $_POST['nota4'];
            $id_nivel_5 = $_POST['nota5'];
            $id_nivel_6 = $_POST['nota6'];
            $nota_final_3 = $_POST['notafinal3'];
            $comentario3 = $_POST['comentario3'];


            echo json_encode($usu->agregar_calificacion(
                $id_matricula,
                $id_curso_docente,
                $id_nivel_1,
                $id_nivel_2,
                $nota_final_1,
                $comentario,
                $nota_final_2,
                $comentario2,
                $id_nivel_3,
                $id_nivel_4,
                $id_nivel_5,
                $id_nivel_6,
                $nota_final_3,
                $comentario3
            ));
            break;
        case "LLENAR_PERIODO":
            echo json_encode($usu->CargarPeriodo());
            break;
        case "SOLO_ESTUDIANTE":
            $id_matricula = $_POST['id_matricula'];
            $id_curso_docente = $_POST['id_curso_docente'];
            echo json_encode($usu->ConsultarEstudiante($id_matricula,$id_curso_docente));
            break;
        case "LLENAR_NIVELES_DESEMPEÑO":
            echo json_encode($usu->NivelesDesempeño());
            break;

    }
}
