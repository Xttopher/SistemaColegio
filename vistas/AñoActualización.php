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
                            <div class="col-md-9 my-3">
                                <label class="form-label">AÑO ESCOLAR</label>
                                <select class="form-select" id="Año_actulizar" onchange="FiltrarPorAño()">

                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once '../parte_inferior.php';
    echo "<script src='../js/salir.js'></script>";
    echo "<script src='../js/admMatricula.js'></script>";
    echo "<script src='../js/cargarFiltroAño.js'></script>";

} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>