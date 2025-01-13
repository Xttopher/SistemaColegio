<?php
require_once '../modelos/usuarioModelo.php';
if ($_POST) {
    $usuc = new Usuarios();
    switch ($_POST['accion']) {
        case "CONSULTAR":
            echo json_encode($usuc->listar_usuarios());
            break;

        case "NUEVO":
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
            echo json_encode($usuc->agregar_usuarios($d, $e, $f, $a, $b, $c, $g, $h, $j));
            break;

        case "CONSULTAR_ID":
            echo json_encode($usuc->ConsultarPorId($_POST['IdUsuario']));
            break;
        case "CONVERTIR_DOCENTE":
            echo json_encode($usuc->ConvertirDocente2($_POST['Estudiante']));
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
            echo json_encode($usuc->editar_usuarios($d, $e, $f, $a, $b, $c, $g, $h, $j, $i, $k));
            break;

        // case "ELIMINAR":
        //     echo json_encode($usu->Eliminar($_POST['IdUsuario'],$condi));
        //     $condi = $_POST['condicion'];
        //     break;
    }
}
