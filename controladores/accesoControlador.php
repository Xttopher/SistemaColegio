<?php
require_once '../modelos/accesoModelo.php';
if($_POST)
{
    $usu=$_POST['usuario'];
    $pass=$_POST['contrasena'];
    $usuario=new Login();

    echo json_encode($usuario->InicioSesion($usu,$pass));
}
?>
