var ruta="../controladores/adminGestorControlador.php";

$(document).ready(function(){
    LlenarDocentes();
    LlenarProgramas();
    LlenarPeriodos();
});

function Agregar() {
    let CursosPC = document.getElementById('CursosPC').value;
    let PAcademico = document.getElementById('PAcademico').value;
    if (CursosPC == "" || PAcademico == "") {
        MostrarAlerta("ALERTA", "Datos no Guardados, Debe Ingresar Todos los datos", "error");
        return;
    }
    $.ajax({
        data: RetornarDatosAGREGAR("AGREGAR_CURSO_DOCENTE"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AsignarCursos').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
            /*limpiar();*/
        }
    })
}
function RetornarDatosAGREGAR(accion) {
    return {
        id_docente: document.getElementById('id_Docente').value,
        id_curso: document.getElementById('CursosPC').value,
        id_periodo: document.getElementById('PAcademico').value,
        accion: accion
    };
}
function LlenarDocentes(){
    $.ajax({
        data: { accion: "LLENAR_DOCENTES" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) { 
            let html = "";        
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.id_docente + "</td>";    
                html += "<td>" + data.dni + "</td>";    
                html += "<td>" + data.nombre_completo + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#EditarAsignarCursos' onclick='Usuario_id(" + data.dni + ")'><i class='mdi mdi-file-edit text-primary mdi-18px'></i></button>"
                html += "<button class='btn btn-dark' title='AsignarCursos' data-bs-toggle='modal' data-bs-target='#AsignarCursos' ><i class='mdi mdi-delete-forever text-success mdi-18px' onclick='AsignarCursos(" + data.id_docente + ")'></i></button>"
                html += "<button class='btn btn-dark' title='Eliminar' ><i class='mdi mdi-delete-forever text-danger mdi-18px' onclick='MostrarAlertaEliminar(" + data.dni + ")'></i></button>"
                html += "</td>";
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
            document.getElementById('PEstudios').innerHTML = html;
            document.getElementById('PEstudiose').innerHTML = html;
        }
    })
}

function LlenarCursos(){
    $.ajax({
        data: RetornarDatos("LLENAR_CURSOS"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option selected>- SELECCIONA EL CURSO ESPECIFICO</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_curso+">"+data.nombre_curso+"</option>";
            });
            document.getElementById('CursosPC').innerHTML = html;
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
function RetornarDatos(accion) {
    return {
        Programa: document.getElementById('PEstudios').value,
        Ciclo: document.getElementById('Ciclo').value,
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
            document.getElementById('Ciclo').innerHTML = html;
            document.getElementById('Cicloe').innerHTML = html;
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
    $('#dtAdminDocente').dataTable({
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