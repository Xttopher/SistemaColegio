<?php
// Establecer los valores de configuración en tiempo de ejecución (antes de procesar el archivo)
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');
ini_set('max_file_uploads', '20');
require_once '../modelos/registroEgresadoModelo.php';
if ($_POST) {
    $cu = new EgresadosDatos();
    switch ($_POST['accion']) {
        case "LISTAR_UBIGEO":
            echo json_encode($cu->cargar_ubigeo());
            break;
        case "NUEVO":
            // Recibir datos de la solicitud
            $dni = $_POST['dni'];
            $ape_paterno = $_POST['ape_paterno'];
            $ape_materno = $_POST['ape_materno'];
            $nombre = $_POST['nombre'];
            $fechanacimiento1 = $_POST['fechanacimiento1'];
            $ubigeo_peru_departments = $_POST['ubigeo_peru_departments'];
            $ubigeo_peru_provinces = $_POST['ubigeo_peru_provinces'];
            $ubigeo_peru_districts = $_POST['ubigeo_peru_districts'];
            $sexo = $_POST['sexo'];
            $nacionalidad = $_POST['nacionalidad'];
            $idioma = $_POST['idioma'];
            $password = md5($_POST['password']);

            if (isset($_FILES['foto_archivo']) && $_FILES['foto_archivo']['error'] == 0) {
                $foto_archivo = $_FILES['foto_archivo'];

                // Definir la carpeta de destino y asegurarse de que exista
                $carpetaDestino = 'uploads/';
                if (!is_dir($carpetaDestino)) {
                    mkdir($carpetaDestino, 0777, true);
                }

                // Generar un nombre único para el archivo (usamos el DNI para evitar duplicados)
                $nombreArchivo = $dni . '_DNI.pdf';
                $rutaArchivo = $carpetaDestino . $nombreArchivo;

                // Mover el archivo a la carpeta de destino
                if (!move_uploaded_file($foto_archivo['tmp_name'], $rutaArchivo)) {
                    echo json_encode("Error: No se pudo mover el archivo.");
                    exit;
                }

            } else {
                $foto_archivo = null;  // Si no se sube un archivo, lo dejamos como null
            }

            echo json_encode($cu->registrar(
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
                $idioma,
                $password,
                $foto_archivo  // Pasar el archivo al método registrar
            ));
            break;
        case "UBIGEO_CONSULTAR_ID":
            echo json_encode($cu->ConsultarPorId($_POST['idCliente']));
            break;
        case "LLENAR_DEPARTAMENTO":
            echo json_encode($cu->LlenarDepartamento());
            break;
        case "LLENAR_PROVINCIA":
            echo json_encode($cu->LlenarProvincias($_POST["departamento"]));
            break;
        case "LLENAR_DISTRITO":
            echo json_encode($cu->LlenarDistritos($_POST["provincia"]));
            break;
        case "AGREGAR_MATRICULA":
            $a = $_POST['dniusuario'];
            $b = md5($_POST['contrasena']);
            echo json_encode($cu->registrar_usuario($a, $b));
            break;
    }
}

