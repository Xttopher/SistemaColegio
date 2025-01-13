<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Mantenimiento de usuarios</h5>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AgregarEgresados" title="Agregar"><i class='mdi mdi-plus-circle mdi-24px'></i></button>
                        <?php
                        require_once 'modalUsuario.php';
                        ?>
                        <table id="dtUsuario" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>DNI/C.E</th>
                                    <th>NOMBRES</th>
                                    <th>APELLIDOS</th>
                                    <th>TIPO</th>
                                    <th>SEXO</th>
                                    <th>FECHA DE NACIMIENTO</th>
                                    <th>UBICACIÓN</th>
                                    <th>CONTRASEÑA</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="datos"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    require_once '../parte_inferior.php';
    echo "<script src='../js/salir.js'></script>";
    echo "<script src='../js/usuarios.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>         
       