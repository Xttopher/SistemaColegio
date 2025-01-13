<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Datos Personales</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <label class="form-label">PERIÓDO ACADÉMICO</label>
                                <select class="form-select" id="peridoacademico" onchange="Cargar()">
                                </select>
                            </div>
                        </div>
                        <input id="dniAlumno" type="hidden" value="<?php echo $_SESSION['perfil'] ?>">
                        <input type="hidden" id="id_matricula_estudiante">
                        <table id="dtEstudianteMisCursos" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>CURSO</th>
                                    <th>DOCENTE</th>
                                    <th>PERIODO ACADÉMICO</th>
                                    <th class="text-center" colspan="2">COMPETENCIA1</th>
                                    <th class="text-center" colspan="2">COMPETENCIA2</th>
                                    <th class="text-center" colspan="2">COMPETENCIA3</th>
                                </tr>
                                <tr>
                                    <th>.</th> <!-- Celda vacía debajo de Nombres Completos -->
                                    <th>.</th> <!-- Celda vacía debajo de CURSO -->
                                    <th>.</th> <!-- Celda vacía debajo de PERIODO ACADÉMICO -->
                                    <th>EP1</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th>EF1</th>
                                    <th>EP2</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th>EF2</th>
                                    <th>EP3</th> <!-- Subencabezado de COMPETENCIA1 -->
                                    <th>EF3</th> <!-- Subencabezado de COMPETENCIA1 -->
                                </tr>
                            </thead>
                            <tbody id="datos"></tbody>
                        </table>
                        <button type="button" class="btn btn-success" onclick="Imprimir()">IMPRIMIR REPORTE FINAL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once '../parte_inferior.php';
    echo "<script src='../js/salir.js'></script>";
    echo "<script src='../js/EstudianteMisNotas.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>