let ruta = '../controladores/datosSacramentoControlador.php';


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
            document.getElementById('añoacademicoa4').innerHTML = html;
            Consultar();
        }   
    })
}

function habilitar(){
    let habilitar = document.getElementById('Bautizo1').value;
    let parroquia = document.getElementById('parroquiaBautizo1');
    let primeraC = document.getElementById('primeraC1');
    let Confirmacion = document.getElementById('Confirmacion1');
    let AsistirMisa = document.getElementById('AsistirMisa1').value;
    let misalugar = document.getElementById('misalugar1');


    if(habilitar == "Si") {
        parroquia.disabled = false;
        primeraC.disabled = false;
        Confirmacion.disabled = false;
    } else if(habilitar == "No") {
        parroquia.disabled = true;
        primeraC.disabled = true;
        Confirmacion.disabled = true;
    };
    if(AsistirMisa == "Si")misalugar.disabled = false;
    if(AsistirMisa == "No")misalugar.disabled = true;
}

function RetornarBusqueda(accion) {
    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('añoacademicoa4').value,
        accion: accion
    };
}
function AgregarSacramentos() {
    $.ajax({
        data: RetornarDatosSacra("NUEVOS_SACRAMENTOS"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                Consultar();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}
function RetornarDatosSacra(accion) {

    return {
        dni: document.getElementById('dniAlumno').value,
        id_periodo: document.getElementById('añoacademicoa4').value,
        bautizado: document.getElementById('Bautizo1').value,
        parroquia_bautizo: document.getElementById('parroquiaBautizo1').value,
        primera_comunion: document.getElementById('primeraC1').value,
        confirmacion: document.getElementById('Confirmacion1').value,
        asistencia_misa: document.getElementById('AsistirMisa1').value,
        parroquia_misa: document.getElementById('misalugar1').value,
        accion: accion
    }
}
function Consultar() {   
    $.ajax({
        data: RetornarBusqueda("CONSULTAR_DT"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('Bautizo1').value= data.bautizado,
            document.getElementById('parroquiaBautizo1').value= data.parroquia_bautizo,
            document.getElementById('primeraC1').value= data.primera_comunion,
            document.getElementById('Confirmacion1').valu= data.confirmacion,
            document.getElementById('AsistirMisa1').value= data.asistencia_misa,
            document.getElementById('misalugar1').value= data.parroquia_misa;
        }
    });
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
