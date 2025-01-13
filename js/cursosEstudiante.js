var ruta="../controladores/usuarioControlador.php";

$(document).ready(function(){
    
});
function Consultar() {
    $.ajax({
        data: { accion:"CONSULTAR" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.dni + "</td>";
                html += "<td>" + data.nombres + "</td>";
                html += "<td>" + data.apellido_paterno+" "+data.apellido_materno + "</td>";
                html += "<td>" + data.tipo_usuario + "</td>";
                html += "<td>" + data.email + "</td>";
                html += "<td>" + data.telefono + "</td>";
                html += "<td>" + data.NombreUsuario + "</td>";
                html += "<td>" + data.contra + "</td>";
                html += "<td>" + data.direccion + "</td>";
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
    $('#dtUsuario').dataTable({
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
            [5],
        ],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}