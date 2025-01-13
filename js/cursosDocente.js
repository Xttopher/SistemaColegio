var ruta = "../controladores/DocenteCursosControlador.php";

$(document).ready(function () {
    BUSCARPERSONA(document.getElementById('dniDocente').value);
    ListarCompetencias();
    LlenarPeriodos();
});
function BUSCARPERSONA(id) {
    $.ajax({
        data: { DniDocente: id, accion: "CONSULTAR_DOCENTE" },
        url: ruta,  
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('id_docente').value= data.id_docente;
        }
    })

}
function Consultar() {
    $("#dtCursosDocente").dataTable().fnDestroy();
    $.ajax({
        data: RetornarDatosBuscar2("CONSULTAR_ID"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.id_curso + "</td>";
                html += "<td>" + data.nombre_curso + "</td>";
                html += "<td>" + data.nombre_periodo + "</td>";
                html += "<td>" + data.nombre_programa + "</td>";
                html += "<td>" + data.nombre_ciclo + "</td>";
                html += "<td>" + data.nombre_competencia_1 + "</td>";
                html += "<td>" + data.nombre_competencia_2 + "</td>";
                html += "<td>" + data.nombre_competencia_3 + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#AsignarCompetencias' onclick='Curso_Docente(" + data.id_curso_docente + ")' >EDITAR</button>";
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    });
}
function RetornarDatosBuscar2(accion) {
    return {
        IdDocente: document.getElementById('id_docente').value,
        Periodo: document.getElementById('pacademico1').value,
        accion: accion
    };
}
function ListarCompetencias(){
    $.ajax({
        data: { accion: "LLENAR_COMPETENCIAS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option selected>- SELECCIONA LA COMPETENCIA -</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_competencia+">"+data.nombre_competencia+"-"+data.competencia+"</option>";
            });
            document.getElementById('Competencia1').innerHTML = html;
            document.getElementById('Competencia2').innerHTML = html;
            document.getElementById('Competencia3').innerHTML = html;

        }
    })
}
function MostrarID(casa){
    document.getElementById('id_curso_docente').value = casa;
}
function AsignarCompetencia() {
    $.ajax({
        data: RetornarDatosCompetencia("EDITAR_EVALUACION_CURSOS_DOCENTE"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AsignarCompetencias').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtCursosDocente").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
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
            document.getElementById('pacademico1').innerHTML = html;
            Consultar();
        }
      
    })
}
function Curso_Docente(id) {
    $.ajax({
        data: { Curso_Docente: id, accion: "BUSCAR_CURSO_DOCENTE" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('Competencia1').value = data.id_competencia_1;
            document.getElementById('NomEvaluacion1').value = data.nombre_evaluacion1;
            document.getElementById('Competencia2').value = data.id_competencia_2;
            document.getElementById('NomEvaluacion2').value = data.nombre_evaluacion2;
            document.getElementById('Competencia3').value = data.id_competencia_3;
            document.getElementById('NomEvaluacion3').value = data.nombre_evaluacion3;
            document.getElementById('id_curso_docente2').value = data.id_curso_docente;
            document.getElementById('cpt11').value = data.id_competencia_1;
        }
    })
}

function RetornarDatosCompetencia(accion) {
    let n1 = document.getElementById('Competencia1').value;
    let n2 = document.getElementById('Competencia2').value;
    let n3 = document.getElementById('Competencia3').value;

    if(n1 == "- SELECCIONA LA COMPETENCIA -")n1 = 13;if(n2 == "")n2 = 13;if(n3 == "")n3 = 13;
    return {
        Competencia1: n1,
        Competencia2: n2,  
        Competencia3: n3,
        NomEvaluacion1: document.getElementById('NomEvaluacion1').value,
        NomEvaluacion2: document.getElementById('NomEvaluacion2').value,
        NomEvaluacion3: document.getElementById('NomEvaluacion3').value,
        id_curso_docente: document.getElementById('id_curso_docente2').value,
        accion: accion
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
    $('#dtCursosDocente').dataTable({
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
        lengthMenu: [[15]],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}
