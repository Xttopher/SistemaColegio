<?php
require 'conexion.php';
class dtPadres
{

    public function BuscarPadres($id, $periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_padre,documento,nombre_completo,tipo_parentesco,correo,direccion,telefono,religion FROM padres p WHERE p.dni = ? AND p.id_año_escolar = ?;");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function registrar_padre111($dni, $id_año_escolar, $documento, $nombre_completo, $tipo_parentesco, $correo, $telefono, $direccion, $vive_con_hijo, $nacionalidad, $religion, $grado_instruccion, $profesion, $centro_trabajo, $trabajador_ipnm, $ex_alumno, $año_egreso, $nombre_ie, $condicion_padres, $foto_padre, $fecha_nacimiento_padre, $distrito_nacimiento)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL registrar_padre2(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $id_año_escolar);
        $stmt->bindParam(3, $documento);
        $stmt->bindParam(4, $nombre_completo);
        $stmt->bindParam(5, $tipo_parentesco);
        $stmt->bindParam(6, $fecha_nacimiento_padre);
        $stmt->bindParam(7, $distrito_nacimiento);
        $stmt->bindParam(8, $correo);
        $stmt->bindParam(9, $telefono);
        $stmt->bindParam(10, $direccion);
        $stmt->bindParam(11, $vive_con_hijo);
        $stmt->bindParam(12, $nacionalidad);
        $stmt->bindParam(13, $religion);
        $stmt->bindParam(14, $grado_instruccion);
        $stmt->bindParam(15, $profesion);
        $stmt->bindParam(16, $centro_trabajo);
        $stmt->bindParam(17, $trabajador_ipnm);
        $stmt->bindParam(18, $ex_alumno);
        $stmt->bindParam(19, $año_egreso);
        $stmt->bindParam(20, $nombre_ie);
        $stmt->bindParam(21, $condicion_padres);
        $stmt->bindParam(22, $foto_padre);


        if ($stmt->execute()) {
            return "OK";  // Se registró correctamente
        } else {
            return "Error: No se pudo guardar la información.";  // Hubo un error
        }
    }


}
