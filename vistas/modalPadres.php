<div class="modal fade" id="AgregarPadre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE PADRES</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formPadre">
                    <div class="row">
                        <input type="hidden" id="id_matricula_padre">
                        <div class="col-md-6">
                            <label for="documentoPadre" class="form-label">N° documento (DNI / C.E / C.I)</label>
                            <input type="text" class="form-control" id="documentoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombreCompletoPadre" class="form-label">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombreCompletoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="tipoParentescoPadre" class="form-label">Tipo de Parentesco</label>
                            <select id="tipoParentescoPadre" name="tipo_parentesco" class="form-select" required>
                                <option selected>Selecciona el Parentesco</option>
                                <option value="Padre">Padre</option>
                                <option value="Madre">Madre</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="fechaNacimientoPadre" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechaNacimientoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="distritoNacimientoPadre" class="form-label">Lugar de Nacimiento</label>
                            <input type="text" class="form-control" id="distritoNacimientoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="correoPadre" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="telefonoPadre" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefonoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="direccionPadre" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccionPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="viveConHijoPadre" class="form-label">¿Vive con su hijo(a)?</label>
                            <select id="viveConHijoPadre" name="vive_con_hijo" class="form-select" required>
                                <option selected>Selecciona una opción</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nacionalidadPadre" class="form-label">Nacionalidad</label>
                            <select class="form-select" id="nacionalidadPadre" required>
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
                        <div class="col-md-6">
                            <label for="religionPadre" class="form-label">Religión</label>
                            <select type="text" class="form-control" id="religionPadre" required>
                                <option selected>Selecciona una religión</option>
                                <option value="Católico">Católico</option>
                                <option value="Cristiano">Cristiano</option>
                                <option value="Evangelista">Evangelista</option>
                                <option value="Israelita">Israelita</option>
                                <option value="Musulmán">Musulmán</option>
                                <option value="Ateo">Ateo</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="gradoInstruccionPadre" class="form-label">Grado de Instrucción</label>
                            <select class="form-select" id="gradoInstruccionPadre" required>
                                <option selected>Selecciona un grado de instrucción</option>
                                <option value="Primaria Completa">Primaria Completa</option>
                                <option value="Secundaria Completa">Secundaria Completa</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Universitario Incompleto">Universitario Incompleto</option>
                                <option value="Universitario Completo">Universitario Completo</option>
                                <option value="Postgrado">Postgrado</option>
                                <option value="Doctorado">Doctorado</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="profesionPadre" class="form-label">Profesión</label>
                            <input type="text" class="form-control" id="profesionPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="centroTrabajoPadre" class="form-label">Centro de Trabajo</label>
                            <input type="text" class="form-control" id="centroTrabajoPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="trabajadorIPNMPadre" class="form-label">¿Trabajador EESPPM?</label>
                            <select name="trajabador_ipnm" class="form-select" id="trabajadorIPNMPadre"required>
                                <option value="No trabaja" selected>No trabaja</option>
                                <option value="Director">Director</option>
                                <option value="Subdirector">Subdirector</option>
                                <option value="Docente">Docente</option>
                                <option value="Asistente Administrativa">Asistente Administrativa</option>
                                <option value="Orientador Educacional">Orientador Educacional</option>
                                <option value="Bibliotecario">Bibliotecario</option>
                                <option value="Secretaria">Secretaria</option>
                                <option value="Personal de Mantenimiento">Personal de Mantenimiento</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="exAlumnoPadre" class="form-label">¿Ex Alumno?</label>
                            <select id="exAlumnoPadre" name="ex_alumno" class="form-select" required>
                                <option selected>Selecciona una opción</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="añoEgresoPadre" class="form-label">Año de Egreso</label>
                            <input type="number" class="form-control" id="añoEgresoPadre" min="1900" max="2100"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="nombreIEPadre" class="form-label">Nombre de la IE</label>
                            <input type="text" class="form-control" id="nombreIEPadre" required>
                        </div>
                        <div class="col-md-6">
                            <label for="condicionPadresPadre" class="form-label">Condición de Padres</label>
                            <select class="form-select" id="condicionPadresPadre" required>
                                <option selected>Selecciona un estado civil</option>
                                <option value="Casado por la Iglesia">Casado por la Iglesia</option>
                                <option value="Casado por Civil">Casado por Civil</option>
                                <option value="Soltero">Soltero</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="fotoPadre" class="form-label">Foto del Padre (formato .png o .jpg)</label>
                            <input type="file" class="form-control" id="fotoPadre" accept="image/png, image/jpeg"
                                required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar" onclick="AgregarPadre();"
                    ;><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/DatosPadres.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>