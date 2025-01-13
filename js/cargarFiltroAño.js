$(document).ready(function(){
    LlenarEscolar();
    ActualizaFecha();
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
            document.getElementById('Año_actulizar').innerHTML = html;
            document.getElementById('peridoacademico5').value = data.id_año_escolar;
            document.getElementById('peridoacademico3').value = data.id_año_escolar;
        }   
    })
}
function ActualizaFecha(){
    let añoActualizable =  document.getElementById('Año_actulizar').value;
    document.getElementById('peridoacademico5').value = añoActualizable;
    document.getElementById('peridoacademico3').value = añoActualizable;
}
function FiltrarPorAño() {
    let fecha_actualizar = document.getElementById('Año_actulizar').value;
    $.ajax({
        data: { IdUsuario: fecha_actualizar, accion: "FILTRO_ANUAL" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('peridoacademico5').value = data.id_año_escolar;
            document.getElementById('peridoacademico3').value = data.id_año_escolar;

        }
    })
}