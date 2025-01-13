<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Mis sacramentos</h5>
                    <div class="card-body">
                        <select class="form-select" id="añoacademicoa4" hidden></select>
                        <input type="hidden" class="form-control" id="dniAlumno" value="<?php echo $_SESSION['perfil'] ?>"
                            disabled>
                        <input type="hidden" id="id_matricula_sacramento2">
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">¿Es bautizado?</label>
                                <select id="Bautizo1" class="form-select" aria-label="Default select example" onclick="habilitar()">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="form-label">Parroquia donde se bautizó (indicar el
                                    distrito)</label>
                                <input type="text" class="form-control" id="parroquiaBautizo1" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">¿Ha recibido la primera comunión?</label>
                                <select id="primeraC1" class="form-select" aria-label="Default select example"
                                    onclick="habilitar()" disabled>
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">¿Ha recibido la confirmación?</label>
                                <select id="Confirmacion1" class="form-select" aria-label="Default select example" disabled>
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">¿Asiste a misa los domingos?</label>
                                <select onclick="habilitar()" id="AsistirMisa1" class="form-select" aria-label="Default select example">
                                    <option value="No">No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="form-label">Parroquia donde asiste</label>
                                <input type="text" class="form-control" id="misalugar1" disabled>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success" onclick="AgregarSacramentos()">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php
    require_once '../parte_inferior.php';
    echo "<script src='../js/salir.js'></script>";
    echo "<script src='../js/usuSacramentos.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>