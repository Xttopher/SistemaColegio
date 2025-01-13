<?php
require_once '../modelos/datosFmModelo.php';
if ($_POST) {
    $dtFm = new datosFmModelo();
    switch ($_POST['accion']) {
        case "CONSULTAR_ID":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($dtFm->ConsultarPorId($dni, $id_periodo));
            break;  
        case "LLENAR_PERIODO":
            echo json_encode($dtFm->CargarPeriodo());
            break;
        case "LLENAR_GRADOS":
            echo json_encode($dtFm->CargarGradosAcademicos());
            break;
        case "NUEVO":
            $a = $_POST['nombre'];
            $b = $_POST['edadFamiliar'];
            $c = $_POST['actividadfm'];
            $d = $_POST['lugFamiliar'];
            $e = $_POST['grado_estudiosfm'];
            $f = $_POST['parentescoFm'];
            $g = $_POST['estudiante_pertenecientefm'];
            $h = $_POST['grado_academicofm'];
            $i = $_POST['exalumnofm'];
            $j = $_POST['año_egresofm'];
            $dni = $_POST['dni'];
            $fecha = $_POST['id_periodo'];
            echo json_encode($dtFm->registrar_familiar($dni,$fecha,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j));
            break;
    }
}
