let ruta = '../controladores/datosPadresControlador.php';

$(document).ready(function () {
    LlenarPeriodos();
});

function LlenarPeriodos(){
    $.ajax({
        data: { accion: "LLENAR_PERIODO" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_año_escolar+">"+data.año+"</option>";
            });
            document.getElementById('peridoacademico12').innerHTML = html;
            Consultar();
        }   
    })
}

function RetornarBusqueda(accion) {
    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('peridoacademico12').value,
        accion: accion
    };
}
function Consultar(){ 

    $.ajax({
        data: RetornarBusqueda("CONSULTAR_PADRES"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.nombre_completo + "</td>";
                html += "<td>" + data.tipo_parentesco + "</td>";
                html += "<td>" + data.correo + "</td>";
                html += "<td>" + data.telefono + "</td>";
                html += "<td>" + data.documento + "</td>";
                html += "<td>" + data.direccion + "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    });

}
function RetornasDatosPadres(accion) {
    let formData = new FormData();
    formData.append("dni", document.getElementById('dniAlumno').value);
    formData.append("id_periodo", document.getElementById('peridoacademico12').value);
    formData.append("documento", document.getElementById('documentoPadre').value);
    formData.append("nombre_completo", document.getElementById('nombreCompletoPadre').value);
    formData.append("tipo_parentesco", document.getElementById('tipoParentescoPadre').value);
    formData.append("fecha_nacimiento_padre", document.getElementById('fechaNacimientoPadre').value);
    formData.append("distrito_nacimiento", document.getElementById('distritoNacimientoPadre').value);
    formData.append("correo", document.getElementById('correoPadre').value);
    formData.append("telefono", document.getElementById('telefonoPadre').value);
    formData.append("direccion", document.getElementById('direccionPadre').value);
    formData.append("vive_con_hijo", document.getElementById('viveConHijoPadre').value);
    formData.append("nacionalidad", document.getElementById('nacionalidadPadre').value);
    formData.append("religion", document.getElementById('religionPadre').value);
    formData.append("grado_instruccion", document.getElementById('gradoInstruccionPadre').value);
    formData.append("profesion", document.getElementById('profesionPadre').value);
    formData.append("centro_trabajo", document.getElementById('centroTrabajoPadre').value);
    formData.append("trajabador_ipnm", document.getElementById('trabajadorIPNMPadre').value);
    formData.append("ex_alumno", document.getElementById('exAlumnoPadre').value);
    formData.append("año_egreso", document.getElementById('añoEgresoPadre').value);
    formData.append("nombre_ie", document.getElementById('nombreIEPadre').value);
    formData.append("condicion_padres", document.getElementById('condicionPadresPadre').value);
    formData.append("foto_padre", document.getElementById('fotoPadre').files[0]);
    formData.append("accion", accion);
    return formData;
}
function AgregarPadre() {
    let error = ValidarCamposPadre();
    if (error) {
        MostrarAlerta("ALERTA", error, "error");
        return;
    }
    $.ajax({
        data: RetornasDatosPadres('REGISTRAR_PADRE'),
        url: ruta,
        type: 'POST',
        contentType: false, 
        processData: false, 
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AgregarPadre').modal('toggle');
                MostrarAlerta("Éxito", "Padre registrado con éxito.", "success");
                $("#dtPadres").dataTable().fnDestroy();
                Consultar();
            } else {
                MostrarAlerta("ALERTA", data, "error");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la solicitud AJAX: " + error);
            MostrarAlerta("ALERTA", "Hubo un error al registrar el padre. Intente nuevamente.", "error");
        }
    });
}

function ValidarCamposPadre() {
    if (!document.getElementById('dniAlumno').value) return "El documento es obligatorio.";
    if (!document.getElementById('peridoacademico12').value) return "El documento es obligatorio.";
    if (!document.getElementById('documentoPadre').value) return "El documento es obligatorio.";
    if (!document.getElementById('nombreCompletoPadre').value) return "El nombre completo es obligatorio.";
    if (!document.getElementById('tipoParentescoPadre').value || document.getElementById('tipoParentescoPadre').value === "Selecciona el Parentesco") return "El tipo de parentesco es obligatorio.";
    if (!document.getElementById('fechaNacimientoPadre').value) return "La fecha de nacimiento es obligatoria.";
    if (!document.getElementById('distritoNacimientoPadre').value) return "El distrito de nacimiento es obligatorio.";
    if (!document.getElementById('correoPadre').value) return "El correo es obligatorio.";
    if (!document.getElementById('telefonoPadre').value) return "El teléfono es obligatorio.";
    if (!document.getElementById('direccionPadre').value) return "La dirección es obligatoria.";
    if (!document.getElementById('viveConHijoPadre').value || document.getElementById('viveConHijoPadre').value === "Selecciona una opción") return "La opción '¿Vive con su hijo(a)?' es obligatoria.";
    if (!document.getElementById('nacionalidadPadre').value) return "La nacionalidad es obligatoria.";
    if (!document.getElementById('religionPadre').value) return "La religión es obligatoria.";
    if (!document.getElementById('gradoInstruccionPadre').value) return "El grado de instrucción es obligatorio.";
    if (!document.getElementById('profesionPadre').value) return "La profesión es obligatoria.";
    if (!document.getElementById('centroTrabajoPadre').value) return "El centro de trabajo es obligatorio.";
    if (!document.getElementById('trabajadorIPNMPadre').value || document.getElementById('trabajadorIPNMPadre').value === "Selecciona una opción") return "La opción '¿Trabajador IPNM?' es obligatoria.";
    if (!document.getElementById('exAlumnoPadre').value || document.getElementById('exAlumnoPadre').value === "Selecciona una opción") return "La opción '¿Ex Alumno?' es obligatoria.";
    if (!document.getElementById('añoEgresoPadre').value) return "El año de egreso es obligatorio.";
    if (!document.getElementById('nombreIEPadre').value) return "El nombre de la IE es obligatorio.";
    if (!document.getElementById('condicionPadresPadre').value) return "La condición de padres es obligatoria.";
    if (!document.getElementById('fotoPadre').files[0]) return "La foto del padre es obligatoria.";
    
    let foto = document.getElementById('fotoPadre').files[0];
    if (foto && !['image/jpeg', 'image/png'].includes(foto.type)) {
        return "Formato de imagen no válido. Solo se permiten JPEG y PNG.";
    }

    if (foto && foto.size > 2 * 1024 * 1024) {
        return "La imagen excede el tamaño permitido (2MB).";
    }
    return null;
}

function limpiarPadre() {
    document.getElementById('formPadre').reset();
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
    $('#dtPadres').dataTable({
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
        lengthMenu: [[40]],
        paging: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,
        responsive: true,
    });
}
