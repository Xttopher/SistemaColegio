var ruta = "../controladores/estudianteControlador.php";

$(document).ready(function () {
    LlenarPeriodos();

});
function BUSCARPERSONA() {
    $.ajax({
        data: RetornarBusqueda("CONSULTAR_ALUMNO"),
        url: ruta,  
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('id_matricula_estudiante').value= data.codMatricula;
            Cargar();
        }
    })

}
function RetornarBusqueda(accion) {
    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('peridoacademico').value,
        accion: accion
    };
}
function LlenarPeriodos(){
    $.ajax({
        data: { accion: "LLENAR_PERIODO" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_periodo+">"+data.nombre_periodo+"</option>";
            });
            document.getElementById('peridoacademico').innerHTML = html;
            BUSCARPERSONA();
        }   
    })
}
function Cargar() {
    Consultar(document.getElementById('id_matricula_estudiante').value);
}

function Consultar(id) {
    $("#dtEstudianteMisCursos").dataTable().fnDestroy();
    $.ajax({
        data: { IdDocente: id, accion: "LLENAR_MIS_CURSOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>.</td>";
                html += "<td>.</td>";
                html += "<td>.</td>";
                html += "<td class='text-center font-weight-bold text-primary' colspan='2'>" + data.competencia_1 + "</td>";
                html += "<td class='text-center font-weight-bold text-success' colspan='2'>" + data.competencia_2 + "</td>";
                html += "<td class='text-center font-weight-bold text-danger' colspan='2'>" + data.competencia_3 + "</td>";
                html += "</tr>";
                html += "<tr>";
                html += "<td>" + data.nombre_curso + "</td>";
                html += "<td>" + data.nombre_docente + "</td>";
                html += "<td>" + data.periodo_academico + "</td>";
                html += "<td>" + data.nivel_1 + "</td>";
                html += "<td>" + data.nivel_2 + "</td>";
                html += "<td>" + data.nivel_3 + "</td>";
                html += "<td>" + data.nivel_4 + "</td>";
                html += "<td>" + data.nivel_5 + "</td>";
                html += "<td>" + data.nivel_6 + "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    });
}
function Imprimir(){
    abrirReporte(document.getElementById('id_matricula_estudiante').value);
}
function abrirReporte(xd) {
    var url = "../vistas/fpdf/ReporteDeNotas.php?id_estudiante=" + xd;
     var ventana = window.open(url, "_blank");
     ventana.onload = function() {
       ventana.print();
    };
 }
function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire({
        title: titulo,
        text: descripcion,
        icon: tipoAlerta,
        confirmButtonColor: '#3085d6',
    });
}

function grid() {
    $('#dtEstudianteMisCursos').dataTable({
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
        lengthMenu: [[10]],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}
