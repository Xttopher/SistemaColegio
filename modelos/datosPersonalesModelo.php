<?php
require 'conexion.php';
class DatosPersonalesq
{

    public function ConsultarPorId($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT u.dni, u.apellido_paterno, u.apellido_materno, u.nombres, u.fecha_nacimiento, u.distrito_nacimiento, u.provincia_nacimiento, u.departamento_nacimiento, u.sexo, u.nacionalidad, u.idioma, u.contra, u.tipo_usuario, dn.name AS distrito_nacimiento1, pn.name AS provincia_nacimiento1, dpn.name AS departamento_nacimiento1 FROM usuario u LEFT JOIN ubigeo_peru_districts dn ON u.distrito_nacimiento = dn.id LEFT JOIN ubigeo_peru_provinces pn ON u.provincia_nacimiento = pn.id LEFT JOIN ubigeo_peru_departments dpn ON u.departamento_nacimiento = dpn.id WHERE u.dni = ?;");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function CargarEstudiante($id, $periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('SELECT 
                m.id_matricula as codMatricula
            FROM 
                matricula m
            INNER JOIN 
                estudiantes e ON m.id_estudiante = e.id_estudiante
            INNER JOIN 
                usuario u ON e.dni = u.dni
            WHERE 
                u.dni = ?
                AND m.id_año_escolar = ?;
        ');
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_año_escolar, año FROM año_escolar ORDER BY id_año_escolar DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function LlenarDepartamento()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select *  FROM ubigeo_peru_departments ORDER BY name ASC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function LlenarProvinciastodos()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select *  FROM ubigeo_peru_provinces ORDER BY name ASC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function LlenarProvincias($id)
    {
        $conex = new Conexion();
        $sql = ("select *  FROM ubigeo_peru_provinces where 1=1 ");
        if (!empty($id)) {
            $sql .= " AND department_id = :cargar ;";
        }
        $stmt = $conex->prepare($sql);

        if (!empty($id)) {
            $stmt->bindParam(':cargar', $id);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function LlenarDistritos($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select *  FROM ubigeo_peru_districts where province_id  = ? ORDER BY name ASC;");
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function LlenarDistritosTodos()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select *  FROM ubigeo_peru_districts ORDER BY name ASC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function actualizar_datos_personales(
        $dni,
        $apellido_paterno,
        $apellido_materno,
        $nombres,
        $fecha_nacimiento,
        $distrito_nacimiento,
        $provincia_nacimiento,
        $departamento_nacimiento,
        $sexo,
        $nacionalidad,
        $idioma
    ) {
        $conex = new Conexion();

        $stmt = $conex->prepare('CALL ActualizarDatosPersonales(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');

        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $apellido_paterno);
        $stmt->bindParam(3, $apellido_materno);
        $stmt->bindParam(4, $nombres);
        $stmt->bindParam(5, $fecha_nacimiento);
        $stmt->bindParam(6, $distrito_nacimiento);
        $stmt->bindParam(7, $provincia_nacimiento);
        $stmt->bindParam(8, $departamento_nacimiento);
        $stmt->bindParam(9, $sexo);
        $stmt->bindParam(10, $nacionalidad);
        $stmt->bindParam(11, $idioma);

        if ($stmt->execute()) {
            return "OK";  // Se actualizó correctamente
        } else {
            return "Error: No se pudo actualizar la información.";  // Hubo un error
        }
    }

}
