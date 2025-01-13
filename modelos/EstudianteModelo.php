<?php
require 'conexion.php';
class EstudiantesDatos
{

    public function CargarEstudiante($id,$periodo)
    {
        $conex = new Conexion();
            $stmt = $conex->prepare('SELECT 
                m.id_matricula as codMatricula
            FROM 
                matricula m
            INNER JOIN 
                estudiante e ON m.id_estudiante = e.id_estudiante
            INNER JOIN 
                usuario u ON e.dni = u.dni
            WHERE 
                u.dni = ?
                AND m.id_periodo = ?;
        ');
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
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

    public function ConsultarPorId($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT 
    ROW_NUMBER() OVER (ORDER BY ci.nombre_ciclo, c.nombre_curso) AS numero_orden,
    c.id_curso, 
    c.nombre_curso, 
    ci.nombre_ciclo, 
    p.nombre_programa,
    
    -- Competencias y evaluaciones correspondientes
    com1.nombre_competencia AS competencia_1,
    com2.nombre_competencia AS competencia_2,
    com3.nombre_competencia AS competencia_3,
    
    -- Relacionamos las notas finales con el nivel de desempeño
    cal2.nota_final_1,
    cal2.nota_final_2,
    cal2.nota_final_3,
    
    -- Niveles de desempeño correspondientes a las calificaciones
    n1.descripcion AS nivel_1,
    n2.descripcion AS nivel_2,
    n3.descripcion AS nivel_3,
    n4.descripcion AS nivel_4,
    n5.descripcion AS nivel_5,
    n6.descripcion AS nivel_6,
    
    -- Nombres de los docentes
    u.nombres AS nombre_docente,
    
    -- Período académico
    pa.nombre_periodo AS periodo_academico

FROM 
    matricula m
INNER JOIN 
    estudiante e ON m.id_estudiante = e.id_estudiante
INNER JOIN 
    cursos c ON m.id_ciclo = c.id_ciclo AND m.id_programa = c.id_programa
INNER JOIN 
    ciclo ci ON c.id_ciclo = ci.id_ciclo
INNER JOIN 
    programadeestudios p ON c.id_programa = p.id_programa
LEFT JOIN 
    cursos_docentes_evaluaciones cde ON c.id_curso = cde.id_curso
LEFT JOIN 
    competencias com1 ON com1.id_competencia = cde.id_competencia_1
LEFT JOIN 
    competencias com2 ON com2.id_competencia = cde.id_competencia_2
LEFT JOIN 
    competencias com3 ON com3.id_competencia = cde.id_competencia_3
LEFT JOIN 
    calificaciones2 cal2 ON cde.id_curso_docente = cal2.id_curso_docente
    AND cal2.id_matricula = m.id_matricula -- Relacionamos por la matrícula
LEFT JOIN 
    niveldedesempeño n1 ON cal2.id_nivel_1 = n1.id_nivel
LEFT JOIN 
    niveldedesempeño n2 ON cal2.id_nivel_2 = n2.id_nivel
LEFT JOIN 
    niveldedesempeño n3 ON cal2.id_nivel_3 = n3.id_nivel
LEFT JOIN 
    niveldedesempeño n4 ON cal2.id_nivel_4 = n4.id_nivel
LEFT JOIN 
    niveldedesempeño n5 ON cal2.id_nivel_5 = n5.id_nivel
LEFT JOIN 
    niveldedesempeño n6 ON cal2.id_nivel_6 = n6.id_nivel
LEFT JOIN 
    docente d ON cde.id_docente = d.id_docente
LEFT JOIN 
    usuario u ON d.dni = u.dni
LEFT JOIN 
    periodoacademico pa ON cde.id_periodo = pa.id_periodo

WHERE 
    m.id_matricula = ?  -- Filtrar por el ID del estudiante
ORDER BY 
    ci.nombre_ciclo, c.nombre_curso;

");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
