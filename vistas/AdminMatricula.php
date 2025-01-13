<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Adminitración de la Matrícula</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <label class="form-label">Año académico</label>
                                <select class="form-select" id="año_Escolar" onchange="LlenarMatriculados()">
                                </select>
                            </div>
                            <div class="col-md-5 my-3">
                                <label class="form-label">Grado</label>
                                <select class="form-select" id="grado_matricula" onchange="LlenarMatriculados()">
                                </select>
                            </div>
                        </div>
                        <table id="dtMatriculados" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>Codigo Matricula</th>
                                    <th>DNI Alumno</th>
                                    <th>Nombres Completos</th>
                                    <th>Grado</th>
                                    <th>Cod.Estudiante</th>
                                    <th>Año Ingreso</th>
                                    <th>Año Académico</th>
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
    echo "<script src='../js/admMatricula.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>