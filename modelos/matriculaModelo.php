<?php
require 'conexion.php';
class Matricula
{   
    public function listar_año()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function listar_matriculados($id, $grado)
    {
        $conex = new Conexion();
        $sql = "SELECT 
                e.id_estudiante AS CodigoEstudiante, 
                u.dni, 
                CONCAT(u.nombres, ' ', u.apellido_paterno, ' ', u.apellido_materno) AS NombreCompleto, 
                m.fecha_matricula AS AñoIngreso, 
                ga.grado AS Grado,
                ae.año AS AñoAcadémico, 
                m.id_matricula 
            FROM 
                EstudianteS e 
            JOIN 
                Usuario u ON e.dni = u.dni 
            JOIN 
                matricula m ON e.id_estudiante = m.id_estudiante 
            JOIN 
                grado_academico ga ON m.id_grado_academico = ga.id_grado_academico 
            JOIN 
                año_escolar ae ON m.id_año_escolar = ae.id_año_escolar 
            WHERE 
                1=1 ";
        if (!empty($id)) {
            $sql .= " AND m.id_año_escolar = :cargar";
        }
        if (!empty($grado)) {
            $sql .= " AND m.id_grado_academico = :grado";
        }
        $stmt = $conex->prepare($sql);

        if (!empty($id)) {
            $stmt->bindParam(':cargar', $id);
        }
        if (!empty($grado)) {
            $stmt->bindParam(':grado', $grado);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function agregar_matricula($p_id_estudiante, $p_id_grado_academico, $p_id_año_escolar)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL InsertarMatricula(?, ?, ?);');
        $stmt->bindParam(1, $p_id_estudiante);
        $stmt->bindParam(2, $p_id_grado_academico);
        $stmt->bindParam(3, $p_id_año_escolar);

        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo guardar la información.";
        }
    }
    public function AgregarAño($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('Call insertarAñoEscolar(?)');
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo guardar la información.";
        }
    }
    public function AñoFiltro($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('select id_año_escolar, año FROM año_escolar from usuario where id_año_escolar=?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $obj_xd=$stmt->fetch(PDO::FETCH_OBJ);
        $_SESSION['año']=$obj_xd->id_año_escolar;
        return "OK";
    }
    public function ConsultarEstudiante($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('SELECT 
                u.*, 
                e.id_estudiante, 
                m.id_grado_academico,
                COALESCE(ga.grado, "Es Nuevo") AS grado_actual,
                COALESCE(ga_siguiente.grado, "0") AS grado_siguiente_texto,  -- Nombre del siguiente grado
                COALESCE(ga_siguiente.id_grado_academico, 0) AS grado_siguiente_id  -- id del siguiente grado
            FROM usuario u
            JOIN estudiantes e ON u.dni = e.dni
            LEFT JOIN matricula m ON m.id_estudiante = e.id_estudiante AND m.id_año_escolar = (
                SELECT id_año_escolar
                FROM año_escolar
                ORDER BY id_año_escolar DESC
                LIMIT 1
            )
            LEFT JOIN grado_academico ga ON ga.id_grado_academico = m.id_grado_academico
            LEFT JOIN grado_academico ga_siguiente ON ga_siguiente.id_grado_academico = m.id_grado_academico + 1
            WHERE u.dni = ?;');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function ConvertirDocente2($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL InsertarDNI(?);');
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo actualizar la información.";
        }
    }

    public function editar_usuarios($dni, $usuario, $contraseña, $nombres, $apellido_paterno, $apellido_materno, $direccion, $email, $fecha_nacimiento, $telefono, $tipo_usuario)
    {
        $conex = new Conexion();

        $stmt = $conex->prepare('CALL editar_usuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $usuario);
        $stmt->bindParam(3, $contraseña);
        $stmt->bindParam(4, $nombres);
        $stmt->bindParam(5, $apellido_paterno);
        $stmt->bindParam(6, $apellido_materno);
        $stmt->bindParam(7, $direccion);
        $stmt->bindParam(8, $email);
        $stmt->bindParam(9, $fecha_nacimiento);
        $stmt->bindParam(10, $telefono);
        $stmt->bindParam(11, $tipo_usuario);

        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo actualizar la información.";
        }
    }

    // public Eliminar($id,$condi)
    // {
    //     $conex = new Conexion();
    //     $stmt = $conex->prepare('call eliminar_usuario(?,?);');
    //     $stmt->bindParam(1, $id);
    //     $stmt->bindParam(2, $condi);

    //     if($stmt->execute())
    //     {
    //         return "OK";
    //     }
    //     else
    //     {
    //         return "Error: se ha generado un error al eliminar la información";
    //     }
    // }
}
