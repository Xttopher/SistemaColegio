let ruta = '../controladores/datosEgresadoControlador.php';

$(document).ready(function () {
    BUSCARPERSONA();
    LlenarAñoEscolar();
    LlenarDepartamento();
    LlenarTodasProvincias();
    LlenarAllDistric();
}); 

function LlenarAñoEscolar(){
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
            document.getElementById('fechaacademica').innerHTML = html;
            BUSCARPERSONA();
        }   
    })
}


function ImprimirReporte() {
    let xd = document.getElementById('dni').value;
    let fecha = document.getElementById('fechaacademica').value;
    var url = "../vistas/fpdf/FichaFamiliar.php?dni=" + xd + "&id_año_escolar=" + fecha;
    var ventana = window.open(url, "_blank");
    ventana.onload = function() {
        ventana.print();
    };
}

function BUSCARPERSONA()
 {
    let id=document.getElementById('dni').value;
    $.ajax({
        data: { dni: id, accion: "CONSULTAR_ID" },
        url: ruta,  
        type: 'post',
        dataType: 'json',
        success: function (data) {
                document.getElementById('ape_paterno').value= data.apellido_paterno,
                document.getElementById('ape_materno').value= data.apellido_materno,
                document.getElementById('nombre31').value= data.nombres,
                document.getElementById('fechanacimiento1').value= data.fecha_nacimiento,
                document.getElementById('ubigeo_peru_departments').value= data.departamento_nacimiento,
                document.getElementById('ubigeo_peru_provinces').value= data.provincia_nacimiento,
                document.getElementById('ubigeo_peru_districts').value= data.distrito_nacimiento,
                document.getElementById('nacionalidad').value= data.nacionalidad,
                document.getElementById('sexo').value= data.sexo,
                document.getElementById('idioma').value= data.idioma;
        }
    })
}
function Actualizar() {
    $.ajax({
        data: RetornarDatosDATOS("ACTUALIZAR"),
        url:ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                MostrarAlerta("Éxito", "Datos Actualizados con Éxito", "success");
            BUSCARPERSONA();
            } else {
                MostrarAlerta("ALERTA", data, "error");
            }
            limpiar();  // Asegúrate de que esta función limpia los campos del formulario
        }   
    });
}
function LlenarDepartamento(){
    $.ajax({
        data: { accion: "LLENAR_DEPARTAMENTO" },
        url: ruta,
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
function LlenarTodasProvincias(){
    $.ajax({
        data: { accion: "LLENAR_TODAS_PROVINCIAS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option value=>- SELECCIONA PROVINCIA DE NACIMIENTO</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id+">"+data.name+"</option>";
            });
            document.getElementById('ubigeo_peru_provinces').innerHTML = html;

        }   
    })
}
function LlenarAllDistric(){
    $.ajax({
        data: { accion: "LLENAR_TODOS_DISTRITOS" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {         
            let html = "<option value=>- SELECCIONA DISTRITO DE NACIMIENTO</option>";
            $.each(data, function (index, data) {
                html += "<option value="+ data.id+">"+data.name+"</option>";
            });
            document.getElementById('ubigeo_peru_districts').innerHTML = html;

        }   
    })
}

function LlenarProvincias(){
    let grado = document.getElementById('ubigeo_peru_departments').value;
    if(document.getElementById('ubigeo_peru_departments').value == ""){
        grado = "";
    }
    $.ajax({
        data: { accion: "LLENAR_PROVINCIA", departamento: grado },
        url: ruta,
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
        url: ruta,
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
function RetornarDatosDATOS(accion) {
    return {
        ape_paterno: document.getElementById('ape_paterno').value,
        ape_materno: document.getElementById('ape_materno').value,
        nombres: document.getElementById('nombre31').value,
        dni: document.getElementById('dni').value,
        fecha_nacimiento: document.getElementById('fechanacimiento1').value,
        ubigeo_peru_departments: document.getElementById('ubigeo_peru_departments').value,
        ubigeo_peru_provinces: document.getElementById('ubigeo_peru_provinces').value,
        ubigeo_peru_districts: document.getElementById('ubigeo_peru_districts').value,
        sexo: document.getElementById('sexo').value,
        nacionalidad: document.getElementById('nacionalidad').value,
        idioma: document.getElementById('idioma').value,
        accion: accion
    };
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
