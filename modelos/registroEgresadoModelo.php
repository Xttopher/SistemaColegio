<?php
require 'conexion.php';
class EgresadosDatos
{
    public function LlenarDepartamento()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select *  FROM ubigeo_peru_departments ORDER BY name ASC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function registrar($dni, $ape_paterno, $ape_materno, $idNomPersonal, $fechanacimiento1, $ubigeo_peru_districts, $ubigeo_peru_provinces, $ubigeo_peru_departments, $sexo, $nacionalidad, $idioma, $password, $foto_archivo)
    {
        try {
            $carpetaDestino = 'uploads/';
            if (!is_dir($carpetaDestino)) {
                if (!mkdir($carpetaDestino, 0777, true)) {
                    throw new Exception("No se pudo crear la carpeta de destino.");
                }
            }

            $nombreArchivo = $dni . '_DNI.' . pathinfo($foto_archivo['name'], PATHINFO_EXTENSION);
            $rutaArchivo = $carpetaDestino . $nombreArchivo;

            $conex = new Conexion();
            $stmt = $conex->prepare('CALL registrar_usuario2(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');
            $stmt->bindParam(1, $dni);
            $stmt->bindParam(2, $ape_paterno);
            $stmt->bindParam(3, $ape_materno);
            $stmt->bindParam(4, $idNomPersonal);
            $stmt->bindParam(5, $fechanacimiento1);
            $stmt->bindParam(6, $ubigeo_peru_districts);
            $stmt->bindParam(7, $ubigeo_peru_provinces);
            $stmt->bindParam(8, $ubigeo_peru_departments);
            $stmt->bindParam(9, $sexo);
            $stmt->bindParam(10, $nacionalidad);
            $stmt->bindParam(11, $idioma);
            $stmt->bindParam(12, $password);
            $stmt->bindParam(13, $rutaArchivo);
            if ($stmt->execute()) {
                return "OK";
            } else {
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Error en la base de datos: " . $errorInfo[2]);
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function cargar_ubigeo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('SELECT 
            dep.id AS departamento_id,
            dep.name AS departamento_name,
            p.id AS provincia_id,
            p.name AS provincia_name,
            d.id AS distrito_id,
            d.name AS distrito_name
        FROM 
            ubigeo_peru_districts d
        JOIN 
            ubigeo_peru_provinces p ON d.province_id = p.id
        JOIN 
            ubigeo_peru_departments dep ON p.department_id = dep.id
        ORDER BY 
            dep.id, p.id, d.name;');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function ConsultarPorId($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('select 
            dep.id AS departamento_id,
            dep.name AS departamento_name,
            p.id AS provincia_id,
            p.name AS provincia_name,
            d.id AS distrito_id,
            d.name AS distrito_name
        FROM 
            ubigeo_peru_districts d
        JOIN 
            ubigeo_peru_provinces p ON d.province_id = p.id
        JOIN 
            ubigeo_peru_departments dep ON p.department_id = dep.id
        where dep.id = ?
        ORDER BY 
            dep.id, p.id, d.name;');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function registrar_usuario($p_dni, $p_password)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('CALL registrar_usuario(?,?);');
        $stmt->bindParam(1, $p_dni);
        $stmt->bindParam(2, $p_password);
        ;
        if ($stmt->execute()) {
            return "OK";
        } else {
            return "Error: No se pudo guardar la información.";
        }
    }
    public function LlenarProvincias($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select *  FROM ubigeo_peru_provinces where department_id = ? ORDER BY name ASC;");
        $stmt->bindParam(1, $id);
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

}
