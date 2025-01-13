<?php
require_once '../modelos/adminCursosModelo.php';
if ($_POST) {
    $usu = new GestorCursos();
    switch ($_POST['accion']) {
        case "LLENAR_CURSOS":
            echo json_encode($usu->listar_docentes());
            break;
        case "LLENAR_CURSOS_ESPECIFICO":
            $i = $_POST['Programa'];
            $k = $_POST['Ciclo'];
            echo json_encode($usu->listar_cursos($i, $k));
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
    }
}
