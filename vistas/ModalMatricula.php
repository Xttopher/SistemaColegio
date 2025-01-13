<div class="modal fade" id="AsignarMatricula" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ASIGNAR MATRÍCULA</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formcliente">
                    <div class="row">
                        <input type="hidden" id="id_estudiante_matricula">
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombre del matriculado</label>
                            <input type="text" class="form-control" id="DatosMatriculaD" placeholder="Ingrese Nombre de Evaluación">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Año académico</label>
                            <select id="Año_matricula" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Grado de procedencia</label>
                            <input type="text" class="form-control" id="grado_procedencia_estudiante" disabled>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Grado promovido</label>
                            <select id="grado_matriculaq_estudiante" class="form-select" aria-label="Default select example">
                                <!-- Opciones -->
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'>CANCELAR</i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar"
                    onclick="AsignarMatricula();" ;><i class='far fa-address-card mdi-24px text-white'> INSCRIBIR</i></button>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/admEstudiantes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>