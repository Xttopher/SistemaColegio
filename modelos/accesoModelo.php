<?php
require 'conexion.php';
class Login
{
    public function InicioSesion($usu,$con)
    {
        $conex=new Conexion();
        $stmt=$conex->prepare("select * from usuario where dni= :usu");
        $stmt->bindValue(":usu",$usu,PDO::PARAM_STR);
        $stmt->execute();
        $obj_usuario=$stmt->fetch(PDO::FETCH_OBJ);

        if(!$obj_usuario)
        {
            return "El Usuario Ingresado es Incorrecto";
        }
        else{
            if($obj_usuario->contra!=md5($con))
            {
                return "La Contraseña Ingresada no Coincide";
            }
            $_SESSION['perfil']=$obj_usuario->dni;  
            $_SESSION['usuario']=$obj_usuario->dni;
            $_SESSION['nom_perfil']=$obj_usuario->nombres;
            $_SESSION['tipo_usuario']=$obj_usuario->tipo_usuario;
            return "OK";
        }
    }
}
?>

