var ruta="../controladores/adminGestorControlador.php";
var r="../controladores/matriculaControlador.php";

$(document).ready(function(){
    LlenarEscolar();
    LlenarGrados();
});
function LlenarEscolar(){
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
            document.getElementById('año_Escolar').innerHTML = html;
            LlenarMatriculados();  
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
            document.getElementById('grado_matricula').innerHTML = html;
        }   
    })
}
function LlenarMatriculados(){
    let año = document.getElementById('año_Escolar').value;
    let grado = document.getElementById('grado_matricula').value;
    if(document.getElementById('año_Escolar').value == 0){
        grado = "";
    }
    $("#dtMatriculados").dataTable().fnDestroy();
    $.ajax({
        data: { Añoescolar: año,Grado: grado,accion: "LLENAR_MATRICULADOS" },
        url: r,
        type: 'post',
        dataType: 'json',
        success: function (data) {  
            let html = "";          
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.id_matricula + "</td>";    
                html += "<td>" + data.dni + "</td>";    
                html += "<td>" + data.NombreCompleto + "</td>";
                html += "<td>" + data.Grado + "</td>";
                html += "<td>" + data.CodigoEstudiante + "</td>";
                html += "<td>" + data.AñoIngreso + "</td>";
                html += "<td>" + data.AñoAcadémico + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Imprimir Reporte' onclick='AbrirReporte(" + data.id_matricula + ")'>IMPRIMIR REPORTE</button>";
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    })
}

function AbrirReporte(xd) {
    var url = "../vistas/fpdf/FichaFamiliar.php?id_estudiante=" + xd;
    var ventana = window.open(url, "_blank");
        ventana.onload = function() {
        ventana.print();
    };
}
function Agregar() {

    $.ajax({
        data: RetornarDatos("NUEVO"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AgregarUsuarios').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtMatriculados").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
            limpiar();
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
    $('#dtMatriculados').dataTable({
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