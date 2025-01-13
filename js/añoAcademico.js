var ruta2="../controladores/matriculaControlador.php";
$(document).ready(function(){
    Consultar();
});

function Consultar(){
    $.ajax({
        data: { accion: "CONSULTAR_AÑO" },
        url: ruta2,
        type: 'post',
        dataType: 'json',
        success: function (data) {  
            let html = "";          
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.id_año_escolar + "</td>";    
                html += "<td>" + data.año + "</td>";    
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#EditarUsuarios' onclick='Usuario_id(" + data.dni + ")'><i class='mdi mdi-file-edit text-primary mdi-18px'></i></button>"
                html += "<button class='btn btn-dark' title='Eliminar' ><i class='mdi mdi-delete-forever text-danger mdi-18px' onclick='MostrarAlertaEliminar(" + data.dni + ")'></i></button>"
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    })
}

function AgregarAñoAcademico() {
    let año2 = document.getElementById('NuevoAcademico').value;
    $.ajax({
        data: { FechaEscolar: año2, accion: "NUEVA_FECHA" },
        url: ruta2,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AgregarAñoAcademico').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtAñoAcademico").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
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
    $('#dtAñoAcademico').dataTable({
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