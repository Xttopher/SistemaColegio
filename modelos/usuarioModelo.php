<?php
require 'conexion.php';
class Usuarios
{
    public function listar_usuarios()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select u.*, d.name AS distrito_nacimiento1, p.name AS provincia_nacimiento1, dep.name AS departamento_nacimiento1 
        FROM usuario u
        LEFT JOIN ubigeo_peru_districts d ON u.distrito_nacimiento = d.id
        LEFT JOIN ubigeo_peru_provinces p ON u.provincia_nacimiento = p.id
        LEFT JOIN ubigeo_peru_departments dep ON u.departamento_nacimiento = dep.id;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function agregar_usuarios($dni, $usuario, $contraseña, $nombres, $apellido_paterno, $apellido_materno, $direccion, $email, $fecha_nacimiento)
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

    public function ConsultarPorId($id)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare('select * from usuario where dni=?');
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
