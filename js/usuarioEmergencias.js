let ruta = '../controladores/datosEmgControlador.php';


$(document).ready(function () {
    LlenarAñoEscolar();
});
function LlenarAñoEscolar() {
    $.ajax({
        data: { accion: "LLENAR_PERIODO" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value=" + data.id_año_escolar + ">" + data.año + "</option>";
            });
            document.getElementById('peridoacademico3').innerHTML = html;
            Consultar();
        }
    })
}

function RetornarBusqueda(accion) {
    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('peridoacademico3').value,
        accion: accion
    };
}
function Consultar() {

    $.ajax({
        data: RetornarBusqueda("CONSULTAR_ID"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.orden + "</td>";
                html += "<td>" + data.numero_contacto + "</td>";
                html += "<td>" + data.nombre_contacto + "</td>";
                html += "<td>" + data.parentesco_contacto + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#EditarEmergenciaDato' onclick='Usuario_id(" + data.id_matricula + ")'>EDITAR</button>";
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    });
}
function Agregar() {
    $.ajax({
        data: RetornarDatosEmer("NUEVO"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AsignarEmergenciaDato').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtEmergencias").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}
function RetornarDatosEmer(accion) {

    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('peridoacademico3').value,
        nomEmergencia: document.getElementById('nomEmergencia').value,
        telEmergencia: document.getElementById('telEmergencia').value,
        parEmergencia: document.getElementById('parEmergencia').value,
        id_matricula_estud: document.getElementById('id_matricula_estud').value,
        accion: accion
    }
}
function Editar() {
    $.ajax({
        data: RetornarDatosEmerEdi("EDITAR_EMERGENCIA"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AsignarEmergenciaDato').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtEmergencias").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}
function RetornarDatosEmerEdi(accion) {

    return {
        id_emergencia: document.getElementById('id_emergencia').value,
        nomEmergencia: document.getElementById('nomEmergenciaE').value,
        telEmergencia: document.getElementById('telEmergenciaE').value,
        parEmergencia: document.getElementById('parEmergenciaE').value,
        accion: accion
    }
}
function Usuario_id(id) {
    $.ajax({
        data: { IdUsuario: id, accion: "CONSULTAR_EMERGENCIA" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('nomEmergenciaE').value = data.nombre_contacto;
            document.getElementById('telEmergenciaE').value = data.numero_contacto;
            document.getElementById('parEmergenciaE').value = data.parentesco_contacto;
            document.getElementById('id_emergencia').value = data.id_emergencia;
        }
    })
}
function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire({
        title: titulo,
        text: descripcion,
        icon: tipoAlerta,
        iconColor: '#6592ff',
        confirmButtonColor: '#3085d6',
        iconColor: '#3085d6',
    });
}
function grid() {
    $('#dtEmergencias').dataTable({
        destroy: true,
        language: {
            info: "Mostrando _START_ a _END_ Registros de _TOTAL_ Registros",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            }
        },
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        lengthMenu: [[40]],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}
