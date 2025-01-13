<?php
require_once '../modelos/datosEmgModelo.php';
if ($_POST) {
    $dtEmg1 = new datosEmgModelo();
    switch ($_POST['accion']) {
        case "CONSULTAR_ID":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($dtEmg1->ConsultarPorId($dni, $id_periodo));
            break;
        case "LLENAR_PERIODO":
            echo json_encode($dtEmg1->CargarPeriodo());
            break;
        case "NUEVO":
            $a = $_POST['telEmergencia'];
            $b = $_POST['nomEmergencia'];
            $c = $_POST['parEmergencia'];
            $k1 = $_POST['id_periodo'];
            $k2 = $_POST['dni'];
            echo json_encode($dtEmg1->registrar_emergencia($k2, $k1, $a, $b, $c));
            break;
        case "CONSULTAR_EMERGENCIA":
            echo json_encode($dtEmg1->consultar_emergencia($_POST['idCliente']));
            break;
            case "EDITAR_EMERGENCIA":
                $a = $_POST['telEmergencia'];
                $b = $_POST['nomEmergencia'];
                $c = $_POST['parEmergencia'];
                $k1 = $_POST['id_periodo'];
                $k2 = $_POST['dni'];
                echo json_encode($dtEmg1->registrar_emergencia($k2, $k1, $a, $b, $c));
                break;
    }
}
