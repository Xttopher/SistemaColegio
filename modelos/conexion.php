<?php
session_start();
class Conexion extends PDO{

    public function __construct()
    {
        try{
            parent::__construct("mysql:host=localhost; dbname=escuela","root","");
            parent::exec("set names utf8");
        }catch(PDOException $e){
            echo "Error al Conectar ".$e->getMessage();
        }
    }
}
?>  