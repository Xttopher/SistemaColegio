<?php
require 'conexion.php';
class GestorCursos
{
    public function listar_docentes()
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from cursos;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function listar_cursos($id,$condi)
    {
        $conex = new Conexion();
        $stmt = $conex->prepare("select * from cursos where 1 = 1 ?,?");
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $condi);
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
