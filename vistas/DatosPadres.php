<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Información de los padres</h5>
                    <div class="card-body">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AgregarPadre"
                            title="Agregar"><i class='mdi mdi-plus-circle mdi-24px'>AGREGAR PADRES</i></button>
                        <?php require_once 'modalPadres.php'; ?>
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <select class="form-select" id="peridoacademico12" hidden>
                                </select>   
                                <input type="hidden" class="form-control" id="dniAlumno" value ="<?php echo $_SESSION['perfil'] ?>" disabled> 
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="id_matricula_padre1"> 
                        <table id="dtPadres" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>Nombre Completo</th>
                                    <th>Parentesco</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>DNI</th>
                                    <th>Dirección</th>
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
    echo "<script src='../js/DatosPadres.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>