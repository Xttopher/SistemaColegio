<?php
require 'conexion.php';
class DtResidencia
{
    public function CargarDatoID($id,$periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_residencia, distrito_domicilio, urb_domicilio, calle_domicilio, num_domicilio, telefono_padre, telefono_madre, alergias, enfermedades_cronicas, id_grado_estudiante FROM residencia r WHERE r.dni = ? AND r.id_año_escolar = ?;");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function registrar_Residencia(
        $dni,
        $id_año_escolar,
        $distrito_domicilio,
        $urb_domicilio,
        $calle_domicilio,
        $num_domicilio,
        $telefono_padre,
        $telefono_madre,
        $alergias,
        $enfermedades_cronicas,
        $imagen_estudiante,
        $grado_academicoR
    ) {
        try {
            $conex = new Conexion();
            $conex->beginTransaction();
            $stmt = $conex->prepare('CALL insertar_o_actualizar_residencia(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
    
            $stmt->bindParam(1, $dni);                         // dni
            $stmt->bindParam(2, $id_año_escolar);              // id_año_escolar
            $stmt->bindParam(3, $distrito_domicilio);          // distrito_domicilio
            $stmt->bindParam(4, $urb_domicilio);               // urb_domicilio
            $stmt->bindParam(5, $calle_domicilio);             // calle_domicilio
            $stmt->bindParam(6, $num_domicilio);               // num_domicilio
            $stmt->bindParam(7, $telefono_padre);              // telefono_padre
            $stmt->bindParam(8, $telefono_madre);              // telefono_madre
            $stmt->bindParam(9, $alergias);                    // alergias
            $stmt->bindParam(10, $enfermedades_cronicas);      // enfermedades_cronicas
            $stmt->bindParam(11, $imagen_estudiante, PDO::PARAM_LOB); // imagen_estudiante (si es tipo BLOB)
            $stmt->bindParam(12, $grado_academicoR);      // enfermedades_cronicas

    
            if ($stmt->execute()) {
                $conex->commit(); 
                return "OK";
            } else {
                $conex->rollBack(); // Revertir los cambios si falla
                return "Error: No se pudo registrar la residencia.";
            }
    
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    

    public function editar_Sacramentos($id_sacramento, $id_matricula, $bautizado, $parroquia_bautizo, $primera_comunion, $confirmacion, $asistencia_misa, $parroquia_misa)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL sp_editar_sacramento(?, ?, ?, ?, ?, ?, ?, ?);');
        $stmt->bindParam(1, $id_sacramento);
        $stmt->bindParam(2, $id_matricula);
        $stmt->bindParam(3, $bautizado);
        $stmt->bindParam(4, $parroquia_bautizo);
        $stmt->bindParam(5, $primera_comunion);
        $stmt->bindParam(6, $confirmacion);
        $stmt->bindParam(7, $asistencia_misa);
        $stmt->bindParam(8, $parroquia_misa);
        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo editar el sacramento.";
        }
    }
    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC;");
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
