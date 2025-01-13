<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Fecha de actualización</h5>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="row">
                                <div class="col-md-5 my-3">
                                    <label class="form-label">Año de actualización</label>
                                    <select class="form-select" id="fechaacademica">
                                    </select>
                                    <input type="hidden" class="form-control" id="dniAlumno"
                                        value="<?php echo $_SESSION['perfil'] ?>">
                                </div>
                            </div>
                        </form>
                    </div>
                    <h5 class="card-header">Datos personales</h5>

                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Apellido paterno</label>
                                <input type="text" class="form-control" id="ape_paterno">
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="form-label">Apellido materno</label>
                                <input type="text" class="form-control" id="ape_materno">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombre31">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" value="<?php echo $_SESSION['perfil'] ?>"
                                    disabled>
                            </div>

                            <h5 for="inputPassword4" class="form-label ">Datos de nacimiento</h5>

                            <div class="col-md-4">
                                <label for="recipient-name" class="form-label">Departamento</label>
                                <select id="ubigeo_peru_departments" class="form-select" aria-label="Default select example"
                                    onchange="LlenarProvincias()">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name" class="form-label">Provincia</label>
                                <select id="ubigeo_peru_provinces" class="form-select" aria-label="Default select example"
                                    onchange="LlenarDistritos()">
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="recipient-name" class="form-label">Distrito</label>
                                <select id="ubigeo_peru_districts" class="form-select" aria-label="Default select example">
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="recipient-name" class="form-label">Fecha de nacimiento</label>
                                <input type="date" class="form-control" id="fechanacimiento1">
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name" class="form-label">Sexo</label>
                                <select id="sexo" class="form-select" aria-label="Default select example">
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name" class="form-label">Nacionalidad</label>
                                <select type="text" class="form-select  " id="nacionalidad">
                                    <option selected>Selecciona una nacionalidad</option>
                                    <option value="Peruana">Peruana </option>
                                    <option value="Mexicana">Mexicana</option>
                                    <option value="Estadounidense">Estadounidense</option>
                                    <option value="Española">Española</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Colombiana">Colombiana</option>
                                    <option value="Brasileña">Brasileña</option>
                                    <option value="Francesa">Francesa</option>
                                    <option value="Italiana">Italiana</option>
                                    <option value="Japonesa">Japonesa</option>
                                    <option value="China">China</option>
                                    <option value="Alemania">Alemana</option>
                                    <option value="Rusa">Rusa</option>
                                    <option value="Canadiense">Canadiense</option>
                                    <option value="Otras">Otras</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name" class="form-label">Idioma</label>
                                <input type="text" class="form-control" id="idioma">
                            </div>
                            <div class="col-12 ">
                                <!-- <button type="button" class="btn btn-success" onclick="ImprimirReporte()">Imprimir ficha familiar</button> -->
                                <button class="btn btn-success " onclick="Actualizar()">Actualizar</button>
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
    echo "<script src='../js/usuarioDatosPersonales.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>