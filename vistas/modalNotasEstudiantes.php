<div class="modal fade" id="AsignarNotasEstudiantes" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ASIGNAR NOTAS</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formcliente">
                    <div class="row">
                        <input type="hidden" id="matricula">
                        <input type="hidden" id="id_curso_profe">
                        <div class="col-4">
                            <label for="recipient-name" class="col-form-label">NOTA 1</label>
                            <select id="nota1" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="recipient-name" class="col-form-label">NOTA 2</label>
                            <select id="nota2" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="recipient-name" class="col-form-label">NOTA 3</label>
                            <select id="nota3" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="recipient-name" class="col-form-label">NOTA 4</label>
                            <select id="nota4" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="recipient-name" class="col-form-label">NOTA 5</label>
                            <select id="nota5" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="recipient-name" class="col-form-label">NOTA 6</label>
                            <select id="nota6" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">NOTA FINAL 1</label>
                            <select id="notafinal1" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">COMENTARIO</label>
                            <input type="text" class="form-control" id="comentario1" maxlength="88" placeholder="Ingrese Comentario">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">NOTA FINAL 2</label>
                            <select id="notafinal2" class="form-select" maxlength="88" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">COMENTARIO2</label>
                            <input type="text" class="form-control" maxlength="88" id="comentario2" placeholder="Ingrese Comentario">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">NOTA FINAL 3</label>
                            <select id="notafinal3" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>  
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">COMENTARIO3</label>
                            <input type="text" class="form-control" id="comentario3" placeholder="Ingrese Comentario">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar"
                    onclick="AgregarNotas();" ;><i
                        class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/NotasEstudiantes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>