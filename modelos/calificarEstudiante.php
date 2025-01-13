<?php
require 'conexion.php';
class CalificarNotas
{
    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_periodo, nombre_periodo FROM periodoacademico ORDER BY id_periodo DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function NivelesDesempeño()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from niveldedesempeño");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function ConsultarEstudiante($id_matricula,$id_curso_docente)
    {
        $conex = new Conexion();
            $stmt = $conex->prepare("SELECT 
                        e.id_estudiante,
                        m.id_matricula AS codmatricula,  -- ID de matrícula
                        c.id_curso,  -- ID de curso
                        CONCAT(u.apellido_paterno, ' ', u.apellido_materno, ' ', u.nombres) AS nombre_estudiante,
                        u.dni,
                        cde.id_curso_docente AS cursodocente, 
                        c.nombre_curso,
                        pa.nombre_periodo,  
                        cde.id_docente,
                        ca.id_calificacion,
                        ca.nota_final_1,
                        ca.nota_final_2,
                        ca.nota_final_3,
                        ca.id_nivel_1 AS nivel_1,  -- Muestra el valor del ID del nivel 1
                        ca.id_nivel_2 AS nivel_2,
                        ca.id_nivel_3 AS nivel_3,
                        ca.id_nivel_4 AS nivel_4,  -- Muestra el valor del ID del nivel 4
                        ca.id_nivel_5 AS nivel_5,  -- Muestra el valor del ID del nivel 5
                        ca.id_nivel_6 AS nivel_6,  -- Muestra el valor del ID del nivel 6
                        ca.comentario,
                        ca.comentario2,
                        ca.comentario3
                        FROM 
                            matricula m
                        INNER JOIN 
                            estudiante e ON m.id_estudiante = e.id_estudiante
                        INNER JOIN 
                            usuario u ON e.dni = u.dni
                        INNER JOIN 
                            cursos_docentes_evaluaciones cde ON m.id_periodo = cde.id_periodo
                        INNER JOIN 
                            cursos c ON cde.id_curso = c.id_curso
                            AND c.id_ciclo = m.id_ciclo 
                            AND c.id_programa = m.id_programa 
                        INNER JOIN 
                            periodoacademico pa ON m.id_periodo = pa.id_periodo
                        LEFT JOIN 
                            calificaciones2 ca ON ca.id_curso_docente = cde.id_curso_docente
                            AND m.id_matricula = ca.id_matricula
                        WHERE   
                             cde.id_curso_docente = ? -- Filtro por curso-docente
                            AND m.id_matricula = ?;  -- Filtro por matrícula
 -- Filtro por ID de matrícula específico
                ORDER BY c.nombre_curso, e.id_estudiante;");
        $stmt->bindParam(1, $id_curso_docente);
        $stmt->bindParam(2, $id_matricula);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function mostrar_cod_evaluacion($id_periodo, $id_docente, $id_curso)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_curso_docente FROM cursos_docentes_evaluaciones WHERE 
        id_periodo = ?  
        AND id_docente = ? 
        AND id_curso = ?;");
        $stmt->bindParam(1, $id_matricula);
        $stmt->bindParam(2, $id_curso_docente);
        $stmt->bindParam(3, $id_nivel_1);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function agregar_calificacion($id_matricula, $id_curso_docente, $id_nivel_1, $id_nivel_2, $nota_final_1, $comentario, $nota_final_2, $comentario2, $id_nivel_3, $id_nivel_4, $id_nivel_5, $id_nivel_6, $nota_final_3, $comentario3)
    {
        $conex = new Conexion(); // Asume que tienes una clase `Conexion` para conectar a la base de datos.
        $stmt = $conex->prepare('CALL registrar_calificaciones(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
        $stmt->bindParam(1, $id_matricula);
        $stmt->bindParam(2, $id_curso_docente);
        $stmt->bindParam(3, $id_nivel_1);
        $stmt->bindParam(4, $id_nivel_2);
        $stmt->bindParam(5, $nota_final_1);
        $stmt->bindParam(6, $comentario);
        $stmt->bindParam(7, $nota_final_2);
        $stmt->bindParam(8, $comentario2);
        $stmt->bindParam(9, $id_nivel_3);
        $stmt->bindParam(10, $id_nivel_4);
        $stmt->bindParam(11, $id_nivel_5);
        $stmt->bindParam(12, $id_nivel_6);
        $stmt->bindParam(13, $nota_final_3);
        $stmt->bindParam(14, $comentario3);

        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo agregar la calificación.";
        }
    }

}