<?php
require 'conexion.php';
class Gestor
{
    /*public function listar_docentes()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT u.dni, d.id_docente, CONCAT(u.nombres, ' ', u.apellido_paterno, ' ', u.apellido_materno) AS nombre_completo FROM Docente d JOIN Usuario u ON d.dni = u.dni ORDER BY  d.id_docente;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function listar_programas()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from programadeestudios;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function listar_ciclos()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from ciclo;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_periodo, nombre_periodo FROM periodoacademico ORDER BY id_periodo DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function agregar_curso_docente($id_curso, $id_docente, $id_periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL InsertarCursoDocente(?, ?, ?);');

        $stmt->bindParam(1, $id_curso);
        $stmt->bindParam(2, $id_docente);
        $stmt->bindParam(3, $id_periodo);
        if ($stmt->execute()) {
            return "OK";  
        } else {
            return "Error: No se pudo guardar la información.";  
        }
    }
    public function listar_cursos($programa, $ciclo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from cursos WHERE id_programa = ? AND id_ciclo = ?;");
        $stmt->bindParam(1, $programa);
        $stmt->bindParam(2, $ciclo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }*/
    public function listar_estudiantes()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT e.id_estudiante AS CodigoEstudiante, u.dni, CONCAT(u.nombres, ' ', u.apellido_paterno, ' ', u.apellido_materno) AS NombreCompleto, e.año_ingreso AS AñoIngreso, e.estado FROM EstudianteS e JOIN Usuario u ON e.dni = u.dni");
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

    public function agregar_usuarios($dni, $usuario, $contraseña, $nombres, $apellido_paterno, $apellido_materno, $direccion, $email, $fecha_nacimiento, $telefono)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL agregar_usuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
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
        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo guardar la información.";
        }
    }
    public function CargarFechaEscolar()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function ConsultarPorId($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('select * from usuario where dni=?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
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
    public function CargarGradosAcademicos()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select id_grado_academico,CASE WHEN id_grado_academico = 0 THEN 'SELECCIONA EL GRADO EN LA I.E. Sagrado Corazón' ELSE grado END AS grado FROM grado_academico;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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
