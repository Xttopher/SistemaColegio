<div class="modal fade" id="AsignarEmergenciaDato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE FAMILIARES</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">
                    <input type="hidden" class="form-control" id="id_matricula_estud"> 
                    <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombres y apellidos</label>
                            <input type="text" class="form-control" maxlength="88" id="nomEmergencia" placeholder="Ingrese el nombre completo">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Teléfono</label>
                            <input type="number" class="form-control" maxlength="2" id="telEmergencia" placeholder="Ingrese el número de teléfono">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Parentesco</label>
                            <select id="parEmergencia" class="form-select" aria-label="Default select example">
                                <option value="Hermano(a)">Hermano/a</option>
                                <option value="Tío(a)">Tío/a</option>
                                <option value="Abuelo(a)">Abuelo/a</option>
                                <option value="Primo(a)">Primo/a</option>
                                <option value="Padrino">Padrino</option>
                                <option value="Madrina">Madrina</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar" onclick="Agregar();"
                    ;><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditarEmergenciaDato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE FAMILIARES</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">
                    <input type="hidden" class="form-control" id="id_emergencia"> 
                    <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombres y apellidos</label>
                            <input type="text" class="form-control" maxlength="88" id="nomEmergenciaE" placeholder="Ingrese el nombre completo">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Teléfono</label>
                            <input type="number" class="form-control" maxlength="2" id="telEmergenciaE" placeholder="Ingrese el número de teléfono">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Parentesco</label>
                            <select id="parEmergenciaE" class="form-select" aria-label="Default select example">
                                <option value="Hermano(a)">Hermano/a</option>
                                <option value="Tío(a)">Tío/a</option>
                                <option value="Abuelo(a)">Abuelo/a</option>
                                <option value="Primo(a)">Primo/a</option>
                                <option value="Padrino">Padrino</option>
                                <option value="Madrina">Madrina</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar" onclick="Editar();"
                    ;><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/usuarioEmergencias.js"></script>
<script src="../js/cargarFiltroAño.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>