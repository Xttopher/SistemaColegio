<?php
require_once '../modelos/datosPadresModelo.php';
if ($_POST) {
    $dtPadresAg = new dtPadres();
    switch ($_POST['accion']) {
        case "CONSULTAR_PADRES":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($dtPadresAg->BuscarPadres($dni, $id_periodo));
            break;
        case "LLENAR_PERIODO":
            echo json_encode($dtPadresAg->CargarPeriodo());
            break;
        case "REGISTRAR_PADRE":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            $documento = $_POST['documento'];
            $nombre_completo = $_POST['nombre_completo'];
            $tipo_parentesco = $_POST['tipo_parentesco'];
            $fecha_nacimiento_padre = $_POST['fecha_nacimiento_padre'];
            $distrito_nacimiento = $_POST['distrito_nacimiento'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $vive_con_hijo = $_POST['vive_con_hijo'];
            $nacionalidad = $_POST['nacionalidad'];
            $religion = $_POST['religion'];
            $grado_instruccion = $_POST['grado_instruccion'];
            $profesion = $_POST['profesion'];
            $centro_trabajo = $_POST['centro_trabajo'];
            $trajabador_ipnm = $_POST['trajabador_ipnm'];
            $ex_alumno = $_POST['ex_alumno'];
            $año_egreso = $_POST['año_egreso'];
            $nombre_ie = $_POST['nombre_ie'];
            $condicion_padres = $_POST['condicion_padres'];
            $foto_padre = isset($_FILES['foto_padre']['tmp_name']) ? file_get_contents($_FILES['foto_padre']['tmp_name']) : NULL;

            echo json_encode($dtPadresAg->registrar_padre111(
                $dni,
                $id_periodo,
                $documento,
                $nombre_completo,
                $tipo_parentesco,
                $correo,
                $telefono,
                $direccion,
                $vive_con_hijo,
                $nacionalidad,
                $religion,
                $grado_instruccion,
                $profesion,
                $centro_trabajo,
                $trajabador_ipnm,
                $ex_alumno,
                $año_egreso,
                $nombre_ie,
                $condicion_padres,
                $foto_padre,
                $fecha_nacimiento_padre,
                $distrito_nacimiento
            ));
            break;
    }
}
