<?php
session_start();
if(isset($_SESSION['perfil']) and isset($_SESSION['usuario']))
{
    require_once '../parte_superior.php';
?>
<img src="../assets/images/monterricofondonotas.jpg" width="100%" height="70%">
<?php
    require_once '../parte_inferior.php';
    echo '<script src="../js/salir.js"></script>';
}
else
{
    echo '<script>
          alert("Usted de Loguearse para Ingresar al Sistema");
          window.location="../index.php";
          </script>';
}
?>
                
         
 