var ruta="../controladores/usuarioControlador.php";

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

function Agregar() {
    /*let nom = document.getElementById('nom').value;
    let ape = document.getElementById('ape').value;
    let cor = document.getElementById('cor').value;
    let usunom = document.getElementById('usunom').value;
    let rol = document.getElementById('rol').value;
    let con = document.getElementById('con').value;
    let esp = document.getElementById('esp').value;
    let num = document.getElementById('num').value;

    if (nom == "" || ape == "" || cor == "" || usunom == "" || rol == "" || con == "" || esp == ""|| num == "") {
        MostrarAlerta("ALERTA", "Datos no Guardados, Debe Ingresar Todos los datos", "error");
        limpiar();
        return;
    }*/
    $.ajax({
        data: RetornarDatos("NUEVO"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AgregarUsuarios').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtUsuario").dataTable().fnDestroy();
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
            limpiar();
        }
    })
}
function RetornarDatos(accion) {
    return {
        nombre: document.getElementById('nom').value,
        apellido_paterno: document.getElementById('apepa').value,
        apellido_materno: document.getElementById('apema').value,
        dni: document.getElementById('dni').value,
        usuario: document.getElementById('usun').value, 
        contrasena: document.getElementById('passn').value,
        direccion: document.getElementById('direccion').value,
        email: document.getElementById('email').value,
        telefono: document.getElementById('telefono').value,
        fnaci: document.getElementById('fnaci').value,
        accion: accion
    }
}
function LlenarSusCursos(){
    $.ajax({
        data: { accion: "LLENAR_MIS_CURSOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.nombre_curso + "</td>";
                html += "<td>" + data.nombre_docente + "</td>";
                html += "<td>" + data.nombre_ciclo + "</td>";
                html += "<td>" + data.nombre_periodo + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#EditarUsuarios' onclick='Usuario_id(" + data.dni + ")'><i class='mdi mdi-file-edit text-primary mdi-18px'></i></button>"
                html += "<button class='btn btn-dark' title='Eliminar' ><i class='mdi mdi-delete-forever text-danger mdi-18px' onclick='MostrarAlertaEliminar(" + data.dni + ")'></i></button>"
                html += "</td>";
                html += "</tr>";
            });
        }
    })
}
function Usuario_id(id) {
    $.ajax({
        data: { IdUsuario: id, accion: "CONSULTAR_ID" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('enom').value = data.nombres;
            document.getElementById('eapepa').value = data.apellido_paterno;
            document.getElementById('eapema').value = data.apellido_materno;
            document.getElementById('edni').value = data.dni;
            document.getElementById('erol').value = data.tipo_usuario;
            document.getElementById('etelefono').value = data.telefono;
            document.getElementById('eemail').value = data.email;
            document.getElementById('efnaci').value = data.fecha_nacimiento;
            document.getElementById('edireccion').value = data.direccion;
            document.getElementById('eusu').value = data.NombreUsuario;
            document.getElementById('epass').value = data.contra;
        }
    })
}
function Editar()
{
    $.ajax({
        data:RetornarDatosEdi("MODIFICAR"),
        url: ruta,
        type: 'post',
        dataType: 'json',

        success:function(data)
        {
            if(data=="OK")
            {
                $('#EditarUsuario').modal('toggle');
                MostrarAlerta("CONFIRMARCIÓN", "Datos actualizados correctamente", "success");
                $('#dtUsuario').dataTable().fnDestroy();
                Consultar();
            }
            else
            {
                MostrarAlerta("ALERTA",data, "error");
            }
            limpiar();
        }
    })
}
// function Eliminar(id)
// {
//     $.ajax({
//         data:{IdUsuario:id, accion:"ELIMINAR", condicion:"DESACTIVO"},
//         url: ruta,
//         type: 'post',
//         dataType: 'json',

//         success:function(data)
//         {
//             if(data!="OK")
//             {
//                 MostrarAlerta("ALERTA",data, "error");
//             }
            
//             $('#dtUsuario').dataTable().fnDestroy();
//             Consultar();
//         }
//     })
// }
// function MostrarAlertaEliminar(id)
// {
//     const swalWithBootstrapButtons = Swal.mixin({
//         customClass: {
//           confirmButton: "btn btn-success",
//           cancelButton: "btn btn-secondary"
//         },
//         buttonsStyling: true
//       });
//       swalWithBootstrapButtons.fire({
//         title: "Alerta!",
//         text: "¿Estas seguro de eliminar el registro?",
//         icon: "warning",
//         iconColor: "#3085d6",
//         showCancelButton: true,
//         confirmButtonText: "Si, Eliminar",
//         cancelButtonText: "No, Cancelar",
//         reverseButtons: true
//       }).then((result) => {
//         if (result.isConfirmed) {
//           swalWithBootstrapButtons.fire({
//             title: "Eliminado!",
//             text: "El registro se eliminó con éxito.",
//             icon: "success",
//             iconColor: "#3085d6"
//           });
//           Eliminar(id);
//         } else if (
//           /* Read more about handling dismissals below */
//           result.dismiss === Swal.DismissReason.cancel
//         ) {
//           swalWithBootstrapButtons.fire({
//             title: "CANCEADO",
//             text: "Se canceló la eliminación",
//             icon: "error"
//           });
//         }
//       });
// }
function RetornarDatosEdi(accion) {
    return {
        nombre: document.getElementById('enom').value,
        apellido_paterno: document.getElementById('eapepa').value,
        apellido_materno: document.getElementById('eapema').value,
        dni: document.getElementById('edni').value,
        rol: document.getElementById('erol').value,
        usuario: document.getElementById('eusu').value, 
        contrasena: document.getElementById('epass').value,
        fnaci: document.getElementById('efnaci').value,
        direccion: document.getElementById('edireccion').value,
        email: document.getElementById('eemail').value,
        telefono: document.getElementById('etelefono').value,
        tipo_usuario: document.getElementById('erol').value,
        accion: accion
    }
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