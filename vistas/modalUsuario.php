<br><br><br>
<div class="modal fade" id="AgregarEgresados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">INGRESE LOS DATOS DEL EDUCANDO</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="Limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="ape_paterno"
                                placeholder="Ingrese el Apellido Paterno">
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="ape_materno"
                                placeholder="Ingrese el Apellido Materno">
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="idNomPersonal"
                                placeholder="Ingrese los Nombres">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" placeholder="Ingrese el DNI">
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Departamento</label>
                            <select id="ubigeo_peru_departments" class="form-select" aria-label="Default select example"
                                onchange="LlenarProvincias()">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Provincia</label>
                            <select id="ubigeo_peru_provinces" class="form-select" aria-label="Default select example"
                                onchange="LlenarDistritos()">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Distrito</label>
                            <select id="ubigeo_peru_districts" class="form-select" aria-label="Default select example">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechanacimiento1">
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Sexo</label>
                            <select id="sexo" class="form-select" aria-label="Default select example">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Nacionalidad</label>
                            <input type="text" class="form-control" id="nacionalidad">
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="form-label">Idioma</label>
                            <input type="text" class="form-control" id="idioma" |>
                        </div>
                        <div class="col-md-12">
                            <label for="foto_archivo" class="form-label">Foto de su DNI (PDF)</label>
                            <input type="file" class="form-control" id="foto_archivo" name="foto_archivo" accept=".pdf">
                            <small class="form-text text-muted">Adjuntar su DNI en formato PDF.</small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="Limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar" onclick="AgregarUsuario();"
                    ;><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="EditarUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuarios</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Nombres</label>
                            <input type="text" class="form-control text-start" id="enom" placeholder="Ingrese Nombre">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" id="eapepa" placeholder="Ingrese Apellido Paterno">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Apellido Materno</label>
                            <input type="text" class="form-control" id="eapema" placeholder="Ingrese Apellido Materno">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">DNI</label>
                            <input type="number" maxlength="8" class="form-control" id="edni" placeholder="Ingrese DNI">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Rol</label>
                            <select id="erol" class="form-select" aria-label="Default select example">
                                <option selected>-ROL-</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Estudiante">Estudiante</option>
                                <option value="Docente">Docente</option>
                                <option value="MesaDePartes">MesaDePartes</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Teléfono</label>
                            <input type="text" class="form-control" id="etelefono" placeholder="Ingrese Teléfono">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Fecha De Nacimiento</label>
                            <input type="date" class="form-control" id="efnaci" placeholder="Ingrese Teléfono">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="eemail" placeholder="Ingrese Email">
                        </div>
                        <div class="col-12">
                            <label for="recipient-name" class="col-form-label">Dirección</label>
                            <input type="text" class="form-control" id="edireccion" placeholder="Ingrese Dirección">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Usuario</label>
                            <input type="text" class="form-control" id="eusu" placeholder="Ingrese Usuario">
                        </div>
                        <div class="col-6">
                            <label for="recipient-name" class="col-form-label">Contraseña</label>
                            <input type="password" class="form-control" id="epass" placeholder="Ingrese Contraseña">
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
<div class="modal fade" id="ConvertirEstudiante" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CONVERTIR A ESTUDIANTE</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" onclick="limpiar3();"><i
                        class='mdi mdi-close-circle-outline mdi-36px'></i></button>
            </div>
            <div class="modal-body">
                <form id="formusuario">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Etiqueta para el campo de datosDocente -->
                            <label for="datosDocente">¿Seguro que quiere convertir a:</label>
                            <input type="text" class="form-control" id="datosDocente" disabled>
                        </div>

                        <div class="col-md-12">
                            <label for="dniUsuario">DNI:</label>
                            <input class="form-control" type="text" id="dniUsuario" disabled>
                        </div>

                        <div class="col-md-12">
                            <label for="">¿a Estudiante?</label>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" title="Cancelar"
                    onclick="limpiar();"><i class='mdi mdi-cancel mdi-24px text-white'></i></button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal" title="Guardar"
                    onclick="ConvertirEstudiante();">SI <i
                        class='mdi mdi-content-save mdi-24px text-white'></i></button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/usuarios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>