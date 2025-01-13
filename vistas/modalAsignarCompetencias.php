<div class="modal fade" id="AsignarCompetencias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ASIGNAR COMPETENCIAS</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formcliente">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="id_curso_docente2">
                            <label for="recipient-name" class="col-form-label">COMPETENCIA 1</label>
                            <select id="Competencia1" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="NomEvaluacion1"
                                placeholder="Ingrese Nombre de Evaluación">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">COMPETENCIA 2</label>
                            <select id="Competencia2" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="NomEvaluacion2"
                            placeholder="Ingrese Nombre de Evaluación">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">COMPETENCIA 3</label>
                            <select id="Competencia3" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombre</label>
                            <input type="text" class="form-control" id="NomEvaluacion3"
                            placeholder="Ingrese Nombre de Evaluación">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar"
                    onclick="AsignarCompetencia();" ;>GUARDAR</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/cursosDocente.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>