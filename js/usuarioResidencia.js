let ruta = '../controladores/datosResidenciaControlador.php';


$(document).ready(function () {
    LlenarPeriodos();
    LlenarGrado();
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
            document.getElementById('añoacademico8').innerHTML = html;
            Consultar();
        }   
    })
}
function LlenarGrado(){
    $.ajax({
        data: { accion: "LLENAR_GRADO" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id_grado_academico+">"+data.grado+"</option>";
            });
            document.getElementById('grado_academicoR').innerHTML = html;
        }   
    })
}

function RetornarBusqueda(accion) {
    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('añoacademico8').value,
        accion: accion
    };
}

function Consultar() {
    $.ajax({
        data: RetornarBusqueda("CONSULTAR_DT"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('disR1').value= data.distrito_domicilio,
            document.getElementById('urbR1').value= data.urb_domicilio,
            document.getElementById('calR1').value= data.calle_domicilio,
            document.getElementById('dptR1').value= data.num_domicilio,
            document.getElementById('movPR1').value= data.telefono_padre,
            document.getElementById('movMR1').value= data.telefono_madre,
            document.getElementById('aleR1').value= data.alergias,
            document.getElementById('enfR1').value= data.enfermedades_cronicas,
            document.getElementById('grado_academicoR').value= data.id_grado_estudiante
        }
    });
    
}

function AgregarResidencia() {

    $.ajax({
        data: RetornarDatosResidencia("NUEVO_RESIDENCIA"),
        url: ruta,
        type: 'POST',
        contentType: false, 
        processData: false, 
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                Consultar();
            } else {
                MostrarAlerta("ALERTA", data, "error");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error en la solicitud AJAX: " + error);
            MostrarAlerta("ALERTA", "Hubo un error al guardar los datos. Intente nuevamente.", "error");
        }
    });
    Consultar();
}

function RetornarDatosResidencia(accion) {
    let formData = new FormData();
    formData.append("dniAlumno", document.getElementById('dniAlumno').value);
    formData.append("añoacademico8", document.getElementById('añoacademico8').value);
    formData.append("distrito_domicilio", document.getElementById('disR1').value);
    formData.append("calle_domicilio", document.getElementById('calR1').value);
    formData.append("urb_domicilio", document.getElementById('urbR1').value);
    formData.append("num_domicilio", document.getElementById('dptR1').value);
    formData.append("telefono_padre", document.getElementById('movPR1').value);
    formData.append("telefono_madre", document.getElementById('movMR1').value);
    formData.append("alergias", document.getElementById('aleR1').value);
    formData.append("enfermedades_cronicas", document.getElementById('enfR1').value);
    formData.append("imagen_estudiante", document.getElementById('imagen_estudiante').files[0]);
    formData.append("grado_academicoR", document.getElementById('grado_academicoR').value);
    formData.append("accion", accion);
    return formData;
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
