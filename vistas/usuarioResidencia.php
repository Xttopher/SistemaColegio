<?php
session_start();
if (isset($_SESSION['perfil']) and isset($_SESSION['usuario'])) {
    require_once '../parte_superior.php';
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header">Mi residencia</h5>
                    <div class="card-body">
                        <select class="form-select" id="añoacademico8" hidden></select>
                        <input type="hidden" class="form-control" id="dniAlumno" value="<?php echo $_SESSION['perfil'] ?>"
                            disabled>
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Distrito</label>
                                <select id="disR1" name="distritos" class="form-select">
                                    <option selected>Selecciona el Distrito</option>
                                    <option value="Ate">Ate</option>
                                    <option value="Barranco">Barranco</option>
                                    <option value="Breña">Breña</option>
                                    <option value="Callao">Callao</option>
                                    <option value="Cercado de Lima">Cercado de Lima</option>
                                    <option value="Chaclacayo">Chaclacayo</option>
                                    <option value="Chorrillos">Chorrillos</option>
                                    <option value="Cieneguilla">Cieneguilla</option>
                                    <option value="Comas">Comas</option>
                                    <option value="El Agustino">El Agustino</option>
                                    <option value="Independencia">Independencia</option>
                                    <option value="Jesús María">Jesús María</option>
                                    <option value="La Molina">La Molina</option>
                                    <option value="La Victoria">La Victoria</option>
                                    <option value="Lince">Lince</option>
                                    <option value="Los Olivos">Los Olivos</option>
                                    <option value="Lurigancho">Lurigancho</option>
                                    <option value="Magdalena del Mar">Magdalena del Mar</option>
                                    <option value="Miraflores">Miraflores</option>
                                    <option value="Pueblo Libre">Pueblo Libre</option>
                                    <option value="Puente Piedra">Puente Piedra</option>
                                    <option value="San Bartolo">San Bartolo</option>
                                    <option value="San Borja">San Borja</option>
                                    <option value="San Isidro">San Isidro</option>
                                    <option value="San Juan de Lurigancho">San Juan de Lurigancho</option>
                                    <option value="San Juan de Miraflores">San Juan de Miraflores</option>
                                    <option value="San Luis">San Luis</option>
                                    <option value="San Martín de Porres">San Martín de Porres</option>
                                    <option value="San Miguel">San Miguel</option>
                                    <option value="Santiago de Surco">Santiago de Surco</option>
                                    <option value="Surquillo">Surquillo</option>
                                    <option value="Villa El Salvador">Villa El Salvador</option>
                                    <option value="Villa María del Triunfo">Villa María del Triunfo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="recipient-name" class="form-label">Urbanización</label>
                                <input type="text" class="form-control" id="urbR1">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Calle/Av.Pasaje</label>
                                <input type="text" class="form-control" id="calR1">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">N°. Drpto/Int</label>
                                <input type="text" class="form-control" id="dptR1">
                            </div>
                            <div class="col-md-3">
                                <label for="inputEmail4" class="form-label">Teléfono del padre</label>
                                <input type="text" class="form-control" id="movPR1">
                            </div>
                            <div class="col-md-3">
                                <label for="inputPassword4" class="form-label">Teléfono de la madre</label>
                                <input type="text" class="form-control" id="movMR1">
                            </div>
                            <div class="col-md-3">
                                <label for="inputPassword4" class="form-label">Grado academico promovido</label>
                                <select id="grado_academicoR" class="form-select" aria-label="Default select example">
                            </select>
                            </div>
                            <div class="col-md-3">
                                <label for="recipient-name" class="form-label">Foto del estudiante (formato .png)</label>
                                <input type="file" class="form-control" id="imagen_estudiante">
                        </div>
                            <label for="inputPassword4" class="form-label">DATOS DE SALUD - Indicar si el estudiante
                                padece:</label>

                            <div class="col-12">
                                <label for="recipient-name" class="form-label">Alergias (Indicar)</label>
                                <input type="text" class="form-control" id="aleR1">
                            </div>
                            <div class="col-md-12">
                                <label for="recipient-name" class="form-label">Enfermedades (Indicar)</label>
                                <input type="text" class="form-control" id="enfR1">
                            </div>

                            <div class="col-6">
                                <button class="btn btn-success" onclick="AgregarResidencia()">Actualizar</button>
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
    echo "<script src='../js/usuarioResidencia.js'></script>";
} else {
    echo '<script>
alert("Usted debe Loguearse para Ingresar al Sistema");
window.location="../index.php";
</script>';
}
?>
<br><br><br>