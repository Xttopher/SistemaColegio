<?php
require 'conexion.php';
class DtSacramento2
{
    public function CargarDatoID($id, $periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * FROM sacramentos s WHERE s.dni = ? AND s.id_año_escolar = ?");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function registrar_Sacramentos($dni, $fecha_aca, $bautizado, $parroquia_bautizo, $primera_comunion, $confirmacion, $asistencia_misa, $parroquia_misa)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL insertar_o_actualizar_sacramento(?,?, ?, ?, ?, ?, ?, ?);');
        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $fecha_aca);
        $stmt->bindParam(3, $bautizado);
        $stmt->bindParam(4, $parroquia_bautizo);
        $stmt->bindParam(5, $primera_comunion);
        $stmt->bindParam(6, $confirmacion);
        $stmt->bindParam(7, $asistencia_misa);
        $stmt->bindParam(8, $parroquia_misa);
        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo registrar el sacramento.";
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


}
