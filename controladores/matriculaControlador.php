<?php
require_once '../modelos/matriculaModelo.php';
if ($_POST) {
    $matricula = new Matricula();
    switch ($_POST['accion']) {
        case "LLENAR_MATRICULADOS":
            $añoescolar = $_POST['Añoescolar'];  // Año Escolar
            $grado = $_POST['Grado'];
            echo json_encode($matricula->listar_matriculados($añoescolar, $grado));
            break;
        case "CONSULTAR_AÑO":
            echo json_encode($matricula->listar_año());
            break;
        case "AGREGAR_MATRICULA":
            $a = $_POST['p_id_estudiante'];
            $b = $_POST['p_id_grado_academico'];
            $c = $_POST['p_id_año_escolar'];
            echo json_encode($matricula->agregar_matricula($a, $b, $c));
            break;

        case "CONSULTAR_ID":
            echo json_encode($matricula->ConsultarEstudiante($_POST['DniEstudiante']));
            break;
        case "FILTRO_ANUAL":
            echo json_encode($matricula->AñoFiltro($_POST['IdUsuario']));
            break;
        case "NUEVA_FECHA":
            echo json_encode($matricula->AgregarAño($_POST['FechaEscolar']));
            break;
        case "CONVERTIR_DOCENTE":
            echo json_encode($matricula->ConvertirDocente2($_POST['Estudiante']));
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
            echo json_encode($matricula->editar_usuarios($d, $e, $f, $a, $b, $c, $g, $h, $j, $i, $k));
            break;

        // case "ELIMINAR":
        //     echo json_encode($usu->Eliminar($_POST['IdUsuario'],$condi));
        //     $condi = $_POST['condicion'];
        //     break;
    }
}
