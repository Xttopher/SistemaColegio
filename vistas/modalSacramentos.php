<br><br><br>
<div class="modal fade" id="AgregarSacramentos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro de sacramentos</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">   
                        <input type="hidden" id="id_matricula_sacramento">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">¿Es bautizado?</label>
                            <select id="Bautizo" class="form-select" aria-label="Default select example"
                                onclick="habilitar()">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Parroquia donde se bautizó (indicar el
                                distrito)</label>
                            <input type="text" class="form-control" id="parroquiaBautizo" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">¿Ha recibido la primera comunión?</label>
                            <select id="primeraC" class="form-select" aria-label="Default select example"
                                onclick="habilitar()" disabled>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">¿Ha recibido la confirmación?</label>
                            <select id="Confirmacion" class="form-select" aria-label="Default select example" disabled>
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">¿Asiste a misa los domingos?</label>
                            <select id="AsistirMisa" class="form-select" aria-label="Default select example"
                                onclick="habilitar()">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Parroquia donde asiste</label>
                            <input type="text" class="form-control" id="misalugar" disabled>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar"
                    onclick="AgregarSacramentos();"><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/usuSacramentos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>