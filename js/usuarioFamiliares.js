let ruta = '../controladores/datosFmControlador.php';


$(document).ready(function () {
    LlenarAñoAcademico();
    GradoAcademico();
});
function Agregar() {

    $.ajax({
        data: RetornarDatosFmla("NUEVO"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AgregarFamiliares').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtDatosFamiliares").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}
function RetornarDatosFmla(accion) {
    return {
        nombre: document.getElementById('nomFamiliar').value,
        edadFamiliar: document.getElementById('edadFamiliar').value,
        actividadfm: document.getElementById('actividadfm').value,
        lugFamiliar: document.getElementById('lugFamiliar').value,
        parentescoFm: document.getElementById('parentescoFm').value,
        grado_estudiosfm: document.getElementById('grado_estudiosfm').value,
        estudiante_pertenecientefm: document.getElementById('estudiante_pertenecientefm').value,
        grado_academicofm: document.getElementById('grado_academicofm').value,
        exalumnofm: document.getElementById('exalumnofm').value,
        año_egresofm: document.getElementById('año_egresofm').value,
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('peridoacademico5').value,
        accion: accion
    }
}
function LlenarAñoAcademico() {
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
            document.getElementById('peridoacademico5').innerHTML = html;
            Consultar();
        }
    })
}

function GradoAcademico() {
    $.ajax({
        data: { accion: "LLENAR_GRADOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value=" + data.id_grado_academico + ">" + data.grado + "</option>";
            });
            document.getElementById('grado_academicofm').innerHTML = html;
        }
    })
}
function RetornarBusqueda(accion) {
    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('peridoacademico5').value,
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
                html += "<td>" + data.nombre_completo + "</td>";
                html += "<td>" + data.edad + "</td>";
                html += "<td>" + data.actividad + "</td>";
                html += "<td>" + data.lugar + "</td>";
                html += "<td>" + data.grado_estudio + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#AsignarNotasEstudiantes' onclick='EstudianteUnico(" + data.id_matricula + ")'>EDITAR</button>";
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    });

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
    $('#dtDatosFamiliares').dataTable({
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
