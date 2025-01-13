<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">En caso de emergencia, comunicarse con:</h5>
                    <div class="card-body">

                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#AsignarEmergenciaDato"
                            title="Agregar"><i class='mdi mdi-plus-circle mdi-24px'>AGREGAR PARIENTES DE EMERGENCIA</i></button>
                        <?php require_once 'modalEmergencias.php'; ?>
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <select class="form-select" id="peridoacademico3" hidden>
                                </select>
                                <input type="hidden" class="form-control" id="dniAlumno" value ="<?php echo $_SESSION['perfil'] ?>" disabled> 
                                <input type="hidden" class="form-control" id="id_matricula_estudiante"> 
                            </div>
                        </div>
                        <table id="dtEmergencias" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>N°</th>
                                    <th>Número</th>
                                    <th>Nombres</th>
                                    <th>Parentesco</th>
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
    echo "<script src='../js/usuarioEmergencias.js'></script>";
    echo "<script src='../js/cargarFiltroAño.js'></script>";

} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>