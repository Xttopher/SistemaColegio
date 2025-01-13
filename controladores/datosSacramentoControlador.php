<?php
require_once '../modelos/datosSacramentoModelo.php';
if ($_POST) {
$drSacramento = new DtSacramento2();
    switch ($_POST['accion']) {
        case "CONSULTAR_DT":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($drSacramento->CargarDatoID($dni, $id_periodo));
            break;

        case "LLENAR_PERIODO":
            echo json_encode($drSacramento->CargarPeriodo());
            break;
        case "NUEVOS_SACRAMENTOS":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            $bautizado = $_POST['bautizado'];
            $parroquia_bautizo = $_POST['parroquia_bautizo'];
            $primera_comunion = $_POST['primera_comunion'];
            $confirmacion = $_POST['confirmacion'];
            $asistencia_misa = $_POST['asistencia_misa'];
            $parroquia_misa = $_POST['parroquia_misa'];
            echo json_encode($drSacramento->registrar_Sacramentos($dni,$id_periodo, $bautizado, $parroquia_bautizo, $primera_comunion, $confirmacion, $asistencia_misa, $parroquia_misa));
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
            echo json_encode($drSacramento->editar_Sacramentos($id_sacramento, $id_matricula, $bautizado, $parroquia_bautizo, $primera_comunion, $confirmacion, $asistencia_misa, $parroquia_misa));
            break;

    }

}
