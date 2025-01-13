var ruta="../controladores/usuarioControlador.php";
let r = '../controladores/registroEgresadoControlador.php';

$(document).ready(function(){
    Consultar();
    LlenarDepartamento();
});
function LlenarDepartamento(){
    $.ajax({
        data: { accion: "LLENAR_DEPARTAMENTO" },
        url: r,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option value=>- SELECCIONA EL DPRTO. DE NACIMIENTO</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id+">"+data.name+"</option>";
            });
            document.getElementById('ubigeo_peru_departments').innerHTML = html;

        }   
    })
}

function LlenarProvincias(){
    $.ajax({
        data: { accion: "LLENAR_PROVINCIA", departamento: document.getElementById('ubigeo_peru_departments').value },
        url: r,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option selected>- SELECCIONA LA PROVINCIA -</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id+">"+data.name+"</option>";
            });
            document.getElementById('ubigeo_peru_provinces').innerHTML = html;
        }
    })
}
function LlenarDistritos(){
    $.ajax({
        data: { accion: "LLENAR_DISTRITO", provincia: document.getElementById('ubigeo_peru_provinces').value },
        url: r,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option selected>- SELECCIONA EL DISTRITO -</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id+">"+data.name+"</option>";
            });
            document.getElementById('ubigeo_peru_districts').innerHTML = html;
        }
    })
}
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
                html += "<td>" + data.sexo + "</td>";
                html += "<td>" + data.fecha_nacimiento + "</td>";
                html += "<td>" + data.distrito_nacimiento1+"-"+data.provincia_nacimiento1+"-"+data.departamento_nacimiento1+ "</td>";
                html += "<td>" + data.contra + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#EditarUsuarios' onclick='Usuario_id(" + data.dni + ")'><i class='mdi mdi-file-edit text-primary mdi-18px'></i></button>"
                html += "<button class='btn btn-dark mx-2' title='ConvertirEstudiante' data-bs-toggle='modal' data-bs-target='#ConvertirEstudiante' onclick='Usuario_id(" + data.dni + ")'><i class='fas fa-address-card text-white mdi-18px'> Inscribir</i></button>"
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    })
}

function AgregarUsuario() {
    /*let formData = new FormData();
        let datosFormulario = RetornarDatosUsuario("NUEVO");
    for (let key in datosFormulario) {
        formData.append(key, datosFormulario[key]);
    }
        let fotoArchivo = document.getElementById('foto_archivo').files[0];
    if (fotoArchivo) {
        formData.append("foto_archivo", fotoArchivo);
    }*/

    $.ajax({
        url: r,  
        type: 'POST',
        data: RetornarDatosUsuario("AGREGAR_NUEVO"),
        dataType: 'json',
        contentType: false,  
        processData: false,  
        success: function(data) {
            if (data == "OK") {
                $('#AgregarEgresados').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtUsuario").dataTable().fnDestroy();
                Consultar();
                limpiar();
            } else {
                MostrarAlerta("ALERTA", data, "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
        }
    });
}
function RetornarDatosUsuario(accion) {
    return {
        ape_paterno: document.getElementById('ape_paterno').value,
        ape_materno: document.getElementById('ape_materno').value,
        nombre: document.getElementById('idNomPersonal').value,
        dni: document.getElementById('dni').value,
        ubigeo_peru_departments: document.getElementById('ubigeo_peru_departments').value,
        ubigeo_peru_provinces: document.getElementById('ubigeo_peru_provinces').value, 
        ubigeo_peru_districts: document.getElementById('ubigeo_peru_districts').value,
        fechanacimiento1: document.getElementById('fechanacimiento1').value,
        sexo: document.getElementById('sexo').value,
        nacionalidad: document.getElementById('nacionalidad').value,
        idioma: document.getElementById('idioma').value,
        password: document.getElementById('dni').value,
        foto_archivo: document.getElementById('foto_archivo').files[0],
        accion: accion
    }
}
function Limpiar() {
    document.getElementById('dni').value = "";
    document.getElementById('ape_paterno').value = "";
    document.getElementById('ape_materno').value = "";
    document.getElementById('idNomPersonal').value = "";
    document.getElementById('fechanacimiento1').value = "";
    document.getElementById('ubigeo_peru_departments').value = "";
    document.getElementById('ubigeo_peru_provinces').value = "";
    document.getElementById('ubigeo_peru_districts').value = "";
    document.getElementById('sexo').value = "";
    document.getElementById('nacionalidad').value = "";
    document.getElementById('idioma').value = "";
    document.getElementById('foto_archivo').value = "";
}

function ConvertirEstudiante(){
    let dnialumno = document.getElementById('dniUsuario').value;
    $.ajax({
        data: { Estudiante: dnialumno, accion: "CONVERTIR_DOCENTE" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#ConvertirEstudiante').modal('toggle');
                MostrarAlerta("Éxito", "Estudiante asignado con Éxito", "success");
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
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
            document.getElementById('dniUsuario').value = data.dni;
            document.getElementById('erol').value = data.tipo_usuario;
            document.getElementById('etelefono').value = data.telefono;
            document.getElementById('eemail').value = data.email;
            document.getElementById('efnaci').value = data.fecha_nacimiento;
            document.getElementById('edireccion').value = data.direccion;
            document.getElementById('eusu').value = data.NombreUsuario;
            document.getElementById('epass').value = data.contra;
            document.getElementById('datosDocente').value = data.nombres+" "+data.apellido_paterno+" "+data.apellido_materno;

        }
    })
}
function limpiar3() {
    document.getElementById("datosDocente").value = "";
    document.getElementById("dniUsuario").value = "";
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
            [100],
        ],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}