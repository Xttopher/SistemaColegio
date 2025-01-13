<div class="modal fade" id="AgregarResidencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de residencia</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">
                        <input type="hidden" id="id_matricula_residencia">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Distrito</label>
                            <select id="disR" name="distritos" class="form-select">
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
                            <label for="inputEmail4" class="form-label">Calle/Av.Pasaje</label>
                            <input type="text" class="form-control" id="calR">
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Urbanización</label>
                            <input type="text" class="form-control" id="urbR">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">N°. Drpto/Int</label>
                            <input type="text" class="form-control" id="dptR">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Teléfono del padre</label>
                            <input type="text" class="form-control" id="movPR">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Teléfono de la madre</label>
                            <input type="text" class="form-control" id="movMR">
                        </div>

                        <label for="inputPassword4" class="form-label">DATOS DE SALUD - Indicar si el estudiante
                            padece:</label>

                        <div class="col-12">
                            <label for="recipient-name" class="form-label">Alergias</label>
                            <input type="text" class="form-control" id="aleR">
                        </div>
                        <div class="col-md-12">
                            <label for="recipient-name" class="form-label">Enfermedades</label>
                            <input type="text" class="form-control" id="enfR">
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar"
                    onclick="AgregarResidencia();"><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/usuarioResidencia.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>