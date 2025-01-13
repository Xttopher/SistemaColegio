var ruta="../controladores/adminGestorControlador.php";
var r2 = "../controladores/matriculaControlador.php";

$(document).ready(function(){
    LlenarEstudiantes();
    LlenarAñoEscolar();
    LlenarGrados();
});

function LlenarEstudiantes(){
    $.ajax({
        data: { accion: "LLENAR_ESTUDIANTES" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {  
            let html = "";          
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.dni + "</td>";    
                html += "<td>" + data.NombreCompleto + "</td>";
                html += "<td>" + data.CodigoEstudiante + "</td>";
                html += "<td>" + data.AñoIngreso + "</td>";
                html += "<td>" + data.estado + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='ConvertirEstudiante' data-bs-toggle='modal' data-bs-target='#AsignarMatricula' onclick='Usuario_id(" + data.dni + ")'><i class='mdi mdi-file-edit text-white mdi-18px'> MATRICULAR</i></button>"
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    })
}
function Usuario_id(id) {
    $.ajax({
        data: { DniEstudiante: id, accion: "CONSULTAR_ALUMNO" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('id_estudiante_matricula').value = data.id_estudiante;
            document.getElementById('DatosMatriculaD').value = data.nombres+" "+data.apellido_paterno+" "+data.apellido_materno;
            document.getElementById('grado_procedencia_estudiante').value = data.grado_actual;
            document.getElementById('grado_matriculaq_estudiante').value = data.grado_siguiente_id;
        }
    })
}

function AsignarMatricula(){

    $.ajax({
        data: RetornarDatosMatriculado("AGREGAR_MATRICULA"),
        url: r2,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AsignarMatricula').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}
function RetornarDatosMatriculado(accion) {
    return {
        p_id_estudiante: document.getElementById('id_estudiante_matricula').value,
        p_id_grado_academico: document.getElementById('grado_matriculaq_estudiante').value,
        p_id_año_escolar: document.getElementById('Año_matricula').value,
        accion: accion
    }
}
function LlenarAñoEscolar(){
    $.ajax({
        data: { accion: "LLENAR_FECHA_ESCOLAR" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_año_escolar+">"+data.año+"</option>";
            });
            document.getElementById('Año_matricula').innerHTML = html;
        } 
        
    })
}
function LlenarGrados(){
    $.ajax({
        data: { accion: "LLENAR_GRADOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_grado_academico+">"+data.grado+"</option>";
            });
            document.getElementById('grado_matriculaq_estudiante').innerHTML = html;
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
    $('#dtAdminEstudiantes').dataTable({
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