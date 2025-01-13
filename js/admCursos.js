var ruta="../controladores/adminCursosControlador.php";

$(document).ready(function(){
    LlenarCursos();
    LlenarProgramas();
    LlenarPeriodos();
    LlenarCiclos();
});

function LlenarCursos(){
    $.ajax({
        data: { accion: "LLENAR_CURSOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) { 
            let html = "";        
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.id_curso + "</td>";    
                html += "<td>" + data.nombre_curso + "</td>";    
                html += "<td>" + data.id_programa + "</td>";
                html += "<td>" + data.id_ciclo + "</td>";
                html += "<td>" + data.creditos + "</td>";
                html += "<td>" + data.codigo_curso + "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    })
}
function AsignarCursos(id_docente){
    document.getElementById("id_Docente").value = id_docente;
}
function LlenarProgramas(){
    $.ajax({
        data: { accion: "LLENAR_PROGRAMAS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option selected>- SELECCIONA EL PROGRAMA DE ESTUDIOS-</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_programa+">"+data.nombre_programa+"</option>";
            });
            document.getElementById('ProgramaDeEstudios').innerHTML = html;
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
            document.getElementById('PAcademico').innerHTML = html;
        }
    })
}
function LlenarCursosEspecifico(){
    $("#dtCursos").dataTable().fnDestroy();
    $.ajax({
        data: RetornarDatosC("LLENAR_CURSOS_ESPECIFICO"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) { 
            let html = "";        
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.id_curso + "</td>";    
                html += "<td>" + data.nombre_curso + "</td>";    
                html += "<td>" + data.id_programa + "</td>";
                html += "<td>" + data.id_ciclo + "</td>";
                html += "<td>" + data.creditos + "</td>";
                html += "<td>" + data.codigo_curso + "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    })
}
function RetornarDatosC(accion) {
    let c1 = document.getElementById('ProgramaDeEstudios').value;
    let c2 = document.getElementById('SemestreEstudios').value;
    let programa = "";
    let ciclo = "";
    if(c1 == ""){programa = "";}
    else{programa = "AND id_programa = "+c1;}
    if(c2 == ""){ciclo = "";}
    else{ciclo = "AND id_ciclo = "+c2;}
    return {
        Programa: programa,
        Ciclo: ciclo,
        accion: accion
    };
}
function LlenarCiclos(){
    $.ajax({
        data: { accion: "LLENAR_CICLOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option selected>- SELECCIONA EL CICLO-</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_ciclo+">"+data.nombre_ciclo+"</option>";
            });
            document.getElementById('SemestreEstudios').innerHTML = html;
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
    $('#dtCursos').dataTable({
        destroy: true,
        language: {
            info: "Mostrando _START_ a _END_ Registros de _TOTAL_ Registros",
            search: "Buscar:",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior",
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
        ],
        lengthMenu: [
            [50],
        ],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}