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
                        <div class="col-md-12">
                            <label for="Id_Dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dniusuario" placeholder="Ingrese el DNI del educando">
                        </div>
                        <div class="col-md-12">
                            <label for="contras" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingrese la contraseña">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Cancelar"
                    onclick="Limpiar();"><i class='mdi mdi-cancel mdi-24px text-danger'></i></button>
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal" title="Guardar" onclick="Registrar();"><i class='mdi mdi-content-save mdi-24px text-primary'></i></button>
            </div>
        </div>
    </div>
</div>
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/acceso.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>