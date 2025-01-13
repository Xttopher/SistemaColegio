<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Adminitración de los Cursos</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <label class="form-label">PROGRAMA DE ESTUDIOS</label>
                                <select class="form-select" id="ProgramaDeEstudios" onchange="LlenarCursosEspecifico()">
                                </select>
                            </div>
                            <div class="col-md-5 my-3">
                                <label class="form-label">CICLO</label>
                                <select class="form-select" id="SemestreEstudios" onchange="LlenarCursosEspecifico()">
                                </select>
                            </div>
                        </div>
                        <table id="dtCursos" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Programa</th>
                                    <th>Ciclo</th>
                                    <th>Créditos</th>
                                    <th>Código</th>
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
    echo "<script src='../js/admCursos.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>