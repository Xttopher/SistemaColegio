<?php
require 'conexion.php';
class datosEmgModelo
{

    public function ConsultarPorId($id, $periodo)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT 
        (@rownum := @rownum + 1) AS orden,nombre_contacto,numero_contacto,parentesco_contacto FROM emergencias e,(SELECT @rownum := 0) AS init
        WHERE e.dni = ? AND e.id_año_escolar = ?
        ORDER BY nombre_contacto;");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $periodo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function CargarPeriodo()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("SELECT id_año_escolar, año 
        FROM año_escolar 
        ORDER BY id_año_escolar DESC
        LIMIT 1;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function registrar_emergencia($dni, $id_año_escolar, $numero_contacto, $nombre_contacto, $parentesco_contacto)
    {
        $conex = new Conexion();

        $stmt = $conex->prepare('CALL RegistrarEmergencia(?, ?, ?, ?, ?);');
        $stmt->bindParam(1, $dni);
        $stmt->bindParam(2, $id_año_escolar);
        $stmt->bindParam(3, $numero_contacto);
        $stmt->bindParam(4, $nombre_contacto);
        $stmt->bindParam(5, $parentesco_contacto);

        if ($stmt->execute()) {
            return "OK";  // Se registró correctamente
        } else {
            return "Error: No se pudo guardar la información.";  // Hubo un error
        }
    }
    public function consultar_emergencia($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('select * from emergencias where id_emergencia=?');
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function editar_emergencia($id_emergencia, $numero_contacto, $nombre_contacto, $parentesco_contacto)
    {
        // Crear una instancia de la conexión
        $conex = new Conexion();

        $stmt = $conex->prepare('CALL EditarEmergencia(?, ?, ?, ?);');

        // Vincular los parámetros con los valores
        $stmt->bindParam(1, $id_emergencia);  // id_emergencia como identificador único
        $stmt->bindParam(2, $numero_contacto);
        $stmt->bindParam(3, $nombre_contacto);
        $stmt->bindParam(4, $parentesco_contacto);

        // Ejecutar el procedimiento y verificar si fue exitoso
        if ($stmt->execute()) {
            return "OK";  // Se actualizó correctamente
        } else {
            return "Error: No se pudo actualizar la información.";  // Hubo un error
        }
    }



}
