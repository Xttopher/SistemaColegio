<div class="modal fade" id="AgregarFamiliares" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="hidden" value="" id="id_matricula_estud">
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Nombres y apellidos</label>
                            <input type="text" class="form-control" maxlength="88" id="nomFamiliar"
                                placeholder="Ingrese el nombre">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Edad</label>
                            <input type="number" class="form-control" maxlength="2" id="edadFamiliar"
                                placeholder="Ingrese la edad">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Actividad</label>
                            <select id="actividadfm" class="form-select" aria-label="Default select example">
                                <option value="Estudiante">Estudiante</option>
                                <option value="Empleado">Empleado</option>
                                <option value="Trabajador">Trabajador</option>
                                <option value="Practicante">Practicante</option>
                                <option value="Profesional">Profesional</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Lugar</label>
                            <input type="text" class="form-control" maxlength="88" id="lugFamiliar"
                                placeholder="Ingrese lugar">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Parentesco</label>
                            <select id="parentescoFm" class="form-select" aria-label="Default select example">
                                <option value="Hermano">Hermano</option>
                                <option value="Hermana">Hermana</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Grado de estudios</label>
                            <select id="grado_estudiosfm" class="form-select" aria-label="Default select example">
                                <option value="Inicial">Educación Inicial</option>
                                <option value="Primaria">Educación Primaria</option>
                                <option value="Secundaria">Educación Secundaria</option>
                                <option value="Licenciatura">Licenciatura o Grado</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                                <option value="Técnico">Formación Técnica</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">¿Estudia en Sagrado Corazón?</label>
                            <select id="estudiante_pertenecientefm" class="form-select"
                                aria-label="Default select example">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Grado</label>
                            <select id="grado_academicofm" class="form-select" aria-label="Default select example">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">¿Es exalumno del S.C?</label>
                            <select id="exalumnofm" class="form-select" aria-label="Default select example">
                                <option value="No">No</option>
                                <option value="Si">Si</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">¿En que año terminó?</label>
                            <input type="number" class="form-control" maxlength="4" id="año_egresofm"
                                placeholder="Ingrese el año de egreso">
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

<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/usuarioFamiliares.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>