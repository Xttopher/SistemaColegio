<?php
require 'conexion.php';
class datosFmModelo
{

    public function ConsultarPorId($id,$periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * FROM familiares f WHERE f.dni = ? AND f.id_año_escolar = ?;");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function registrar_familiar($dni, $id_año_escolar, $nombre_completo, $edad, $actividad, $lugar, $grado_estudio, $parentesco, $estudiante_perteneciente, $grado_colegio, $ex_alumno, $año_egreso)
    {
        $conex = new Conexion();

        $stmt = $conex->prepare('CALL RegistrarFamiliar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $id_año_escolar);
        $stmt->bindParam(3, $nombre_completo);
        $stmt->bindParam(4, $edad);
        $stmt->bindParam(5, $actividad);
        $stmt->bindParam(6, $lugar);
        $stmt->bindParam(7, $grado_estudio);
        $stmt->bindParam(8, $parentesco);
        $stmt->bindParam(9, $estudiante_perteneciente);
        $stmt->bindParam(10, $grado_colegio);
        $stmt->bindParam(11, $ex_alumno);
        $stmt->bindParam(12, $año_egreso);

        if ($stmt->execute()) {
            return "OK";  // Se registró correctamente
        } else {    
            return "Error: No se pudo guardar la información.";  // Hubo un error
        }
    }
    public function editar_familiar($dni, $id_año_escolar, $nombre_completo, $edad, $actividad, $lugar, $grado_estudio, $parentesco, $estudiante_perteneciente, $grado_colegio, $ex_alumno, $año_egreso)
    {
        $conex = new Conexion();

        $stmt = $conex->prepare('CALL EditarFamiliar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        // Vincular los parámetros con los valores
        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $id_año_escolar);
        $stmt->bindParam(3, $nombre_completo);
        $stmt->bindParam(4, $edad);
        $stmt->bindParam(5, $actividad);
        $stmt->bindParam(6, $lugar);
        $stmt->bindParam(7, $grado_estudio);
        $stmt->bindParam(8, $parentesco);
        $stmt->bindParam(9, $estudiante_perteneciente);
        $stmt->bindParam(10, $grado_colegio);
        $stmt->bindParam(11, $ex_alumno);
        $stmt->bindParam(12, $año_egreso);

        if ($stmt->execute()) {
            return "OK";  
        } else {
            return "Error: No se pudo actualizar la información.";  // Hubo un error
        }
    }

    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function CargarGradosAcademicos()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_grado_academico,CASE WHEN id_grado_academico = 0 THEN 'SELECCIONA EL GRADO EN LA I.E. Sagrado Corazón' ELSE grado END AS grado FROM grado_academico;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
