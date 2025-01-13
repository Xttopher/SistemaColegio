<?php
require_once '../modelos/datosPersonalesModelo.php';
if ($_POST) {
    $za = new DatosPersonalesq();
    switch ($_POST['accion']) {
        case "CONSULTAR_ID":
            echo json_encode($za->ConsultarPorId($_POST['dni']));
            break;
        case "CONSULTAR_ALUMNO":
            $dni = $_POST['dni'];
            $id_periodo = $_POST['id_periodo'];
            echo json_encode($za->CargarEstudiante($dni, $id_periodo));
            break;
        case "LLENAR_PERIODO":
            echo json_encode($za->CargarPeriodo());
            break;
        case "LLENAR_DEPARTAMENTO":
            echo json_encode($za->LlenarDepartamento());
            break;
        case "LLENAR_TODAS_PROVINCIAS":
            echo json_encode($za->LlenarProvinciastodos());
            break;
        case "LLENAR_TODOS_DISTRITOS":
            echo json_encode($za->LlenarDistritosTodos());
            break;
        case "LLENAR_PROVINCIA":
            echo json_encode($za->LlenarProvincias($_POST["departamento"]));
            break;
        case "LLENAR_DISTRITO":
            echo json_encode($za->LlenarDistritos($_POST["provincia"]));
            break;
        case "ACTUALIZAR":
            $dni = $_POST['dni'];
            $ape_paterno = $_POST['ape_paterno'];
            $ape_materno = $_POST['ape_materno'];
            $nombre = $_POST['nombres'];
            $fechanacimiento1 = $_POST['fecha_nacimiento'];
            $ubigeo_peru_departments = $_POST['ubigeo_peru_departments'];
            $ubigeo_peru_provinces = $_POST['ubigeo_peru_provinces'];
            $ubigeo_peru_districts = $_POST['ubigeo_peru_districts'];
            $sexo = $_POST['sexo'];
            $nacionalidad = $_POST['nacionalidad'];
            $idioma = $_POST['idioma'];
            echo json_encode($za->actualizar_datos_personales(
                $dni,
                $ape_paterno,
                $ape_materno,
                $nombre,
                $fechanacimiento1,
                $ubigeo_peru_districts,
                $ubigeo_peru_provinces,
                $ubigeo_peru_departments,
                $sexo,
                $nacionalidad,
                $idioma
            ));
            break;
    }
}
