<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Mi Criterio de Evaluación</h5>
                    <div class="card-body">

                        <?php
                        require_once 'modalAsignarCompetencias.php';
                        ?>
                        <div class="row">
                            <div class="col-md-5 my-3">
                                <label class="form-label">PERIÓDO ACADÉMICO</label>
                                <select class="form-select" id="pacademico1" onchange="Consultar()" >
                                </select>
                            </div>
                        </div>
                        <input id="dniDocente" type="hidden" value="<?php echo $_SESSION['perfil'] ?>">
                        <input type="hidden" id="id_docente">
                        <table id="dtCursosDocente" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="barra">
                                    <th>ID</th>
                                    <th>CURSO</th>
                                    <th>PERIODO ACADÉMICO</th>
                                    <th>PROGRAMA DE ESTUDIOS</th>
                                    <th>CICLO</th>
                                    <th>COMPETENCIA1</th>
                                    <th>COMPETENCIA2</th>
                                    <th>COMPETENCIA3</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="datos"></tbody>
                        </table>
                        <button>ACTUALIZAR</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once '../parte_inferior.php';
    echo "<script src='../js/salir.js'></script>";
    echo "<script src='../js/cursosDocente.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>