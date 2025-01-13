<?php
require 'conexion.php';
class DocentesCursos
{

    public function CargarDocente($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('SELECT d.id_docente, pa.id_periodo, pa.nombre_periodo FROM docente d INNER JOIN usuario u ON d.dni = u.dni INNER JOIN cursos_docentes_evaluaciones cd ON d.id_docente = cd.id_docente INNER JOIN periodoacademico pa ON cd.id_periodo = pa.id_periodo WHERE u.dni = ? ORDER BY pa.id_periodo DESC LIMIT 1;');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function BuscarCursoDocente($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('select * from cursos_docentes_evaluaciones where id_curso_docente = ?;');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_periodo, nombre_periodo FROM periodoacademico ORDER BY id_periodo DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function CargarCompetencias()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from competencias;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function CargarEnComboCursos($id, $periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT cde.id_curso_docente, c.id_curso, c.nombre_curso, pa.nombre_periodo, ci.nombre_ciclo, p.nombre_programa 
            FROM cursos_docentes_evaluaciones cde
            INNER JOIN cursos c ON cde.id_curso = c.id_curso
            INNER JOIN periodoacademico pa ON cde.id_periodo = pa.id_periodo
            INNER JOIN ciclo ci ON c.id_ciclo = ci.id_ciclo
            INNER JOIN programadeestudios p ON c.id_programa = p.id_programa
            WHERE cde.id_docente = ? AND pa.id_periodo = ?
            ORDER BY cde.id_curso_docente asc");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function CargarCursos($dx,$id_periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('SELECT 
    d.id_docente,
    cde.id_curso_docente,
    c.id_curso,
    c.nombre_curso,
    pa.id_periodo,
    pa.nombre_periodo,
    ci.nombre_ciclo,
    p.nombre_programa,
    cde.id_competencia_1,
    co1.competencia AS nombre_competencia_1,
    cde.id_competencia_2,
    co2.competencia AS nombre_competencia_2,
    cde.id_competencia_3,
    co3.competencia AS nombre_competencia_3
FROM 
    cursos_docentes_evaluaciones cde
INNER JOIN 
    docente d ON cde.id_docente = d.id_docente
INNER JOIN 
    cursos c ON cde.id_curso = c.id_curso
INNER JOIN 
    periodoacademico pa ON cde.id_periodo = pa.id_periodo
INNER JOIN 
    ciclo ci ON c.id_ciclo = ci.id_ciclo
INNER JOIN 
    programadeestudios p ON c.id_programa = p.id_programa
LEFT JOIN 
    competencias co1 ON cde.id_competencia_1 = co1.id_competencia
LEFT JOIN 
    competencias co2 ON cde.id_competencia_2 = co2.id_competencia
LEFT JOIN 
    competencias co3 ON cde.id_competencia_3 = co3.id_competencia
WHERE 
    d.id_docente = ?
    and pa.id_periodo = ?;

            ');
        $stmt->bindParam(1, $dx);
        $stmt->bindParam(2, $id_periodo);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function CargarMisEstudiantes($id, $id_periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT 
    e.id_estudiante,
    m.id_matricula,  -- ID de matrícula
    c.id_curso,  -- ID de curso
    CONCAT(u.apellido_paterno, ' ', u.apellido_materno, ' ', u.nombres) AS nombre_estudiante,
    u.dni,
    c.nombre_curso,
    pa.nombre_periodo,  
    cde.id_docente,
    ca.id_calificacion,
    ca.nota_final_1,
    ca.nota_final_2,
    ca.nota_final_3,
    n1.descripcion AS nivel_1,
    n2.descripcion AS nivel_2,
    n3.descripcion AS nivel_3,
    n4.descripcion AS nivel_4,
    n5.descripcion AS nivel_5,
    n6.descripcion AS nivel_6,
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
LEFT JOIN 
    niveldedesempeño n1 ON ca.id_nivel_1 = n1.id_nivel
LEFT JOIN 
    niveldedesempeño n2 ON ca.id_nivel_2 = n2.id_nivel
LEFT JOIN 
    niveldedesempeño n3 ON ca.id_nivel_3 = n3.id_nivel
LEFT JOIN 
    niveldedesempeño n4 ON ca.id_nivel_4 = n4.id_nivel
LEFT JOIN 
    niveldedesempeño n5 ON ca.id_nivel_5 = n5.id_nivel
LEFT JOIN 
    niveldedesempeño n6 ON ca.id_nivel_6 = n6.id_nivel
WHERE 
     pa.id_periodo = ? -- Filtro por periodo
    AND cde.id_curso_docente = ? -- Cambia este valor por el id_docente deseado
ORDER BY u.apellido_paterno;");
        $stmt->bindParam(1, $id_periodo);
        $stmt->bindParam(2, $id);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function editar_evaluacion_cursos_docente($id_evaluacion_competencia, $id_competencia_1, $nombre_evaluacion1, $id_competencia_2, $nombre_evaluacion2, $id_competencia_3, $nombre_evaluacion3) {
        $conex = new Conexion();
        try {
            $stmt = $conex->prepare('CALL actualizar_evaluacion_competencias(?, ?, ?, ?, ?, ?, ?);');
            $stmt->bindParam(1, $id_evaluacion_competencia, PDO::PARAM_INT);
            $stmt->bindParam(2, $id_competencia_1, PDO::PARAM_INT);
            $stmt->bindParam(3, $nombre_evaluacion1, PDO::PARAM_STR);
            $stmt->bindParam(4, $id_competencia_2, PDO::PARAM_INT);
            $stmt->bindParam(5, $nombre_evaluacion2, PDO::PARAM_STR);
            $stmt->bindParam(6, $id_competencia_3, PDO::PARAM_INT);
            $stmt->bindParam(7, $nombre_evaluacion3, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                return "OK";
            } else {
                return "Error: No se pudo guardar la información.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    
    
    
    
    
    

}
