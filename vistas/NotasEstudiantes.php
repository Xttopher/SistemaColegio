<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Notas de los Alumnos</h5>
                    <div class="card-body">
                        <?php
                        require_once 'modalNotasEstudiantes.php';
                        ?>
                        <input id="dniDocente" type="hidden" value="<?php echo $_SESSION['perfil'] ?>">
                        <input type="hidden" id="id_docente">
                        <input type="hidden" id="id_curso_profe2">
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <label class="form-label">PERIÓDO ACADÉMICO</label>
                                <select class="form-select" id="peridoacademico" onchange="CargarNotasEstudiantesVer();">
                                </select>
                            </div>
                            <div class="col-md-5 my-3">
                                <label class="form-label">CURSO</label>
                                <select class="form-select" id="CursoS1" onchange="CargarNotasEstudiantesVer();">

                                </select>
                            </div>
                        </div>

                        <table id="dtNotasEstudiantes" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>DNI Alumno</th>
                                    <th>Nombres Completos</th>
                                    <th>CURSO</th>
                                    <th>P. ACADÉMICO</th>
                                    <th id="cpt1" colspan="2">COMPETENCIA1</th>
                                    <th colspan="2">COMPETENCIA2</th> 
                                    <th colspan="2">COMPETENCIA3</th> 
                                    <th></th>
                                </tr>
                                <tr>
                                    <th></th> <!-- Celda vacía debajo de DNI Alumno -->
                                    <th></th> <!-- Celda vacía debajo de Nombres Completos -->
                                    <th></th> <!-- Celda vacía debajo de CURSO -->
                                    <th></th> <!-- Celda vacía debajo de PERIODO ACADÉMICO -->
                                    <th>EP1</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th>EF1</th>
                                    <th>EP2</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th>EF2</th>
                                    <th>EP3</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th>EF3</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th></th> <!-- Celda vacía debajo del último encabezado -->
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
    echo "<script src='../js/NotasEstudiantes.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>