<?php
require_once '../modelos/EstudianteModelo.php';
if ($_POST) {
    $cli = new EstudiantesDatos();
    switch ($_POST['accion']) {
        case "CONSULTAR_ALUMNO":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($cli->CargarEstudiante($dni, $id_periodo));
            break;
        case "LLENAR_MIS_CURSOS":
            echo json_encode($cli->ConsultarPorId($_POST['IdDocente']));
            break;
        case "LLENAR_PERIODO":
            echo json_encode($cli->CargarPeriodo());
            break;

    }
}
