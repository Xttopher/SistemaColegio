let ruta='../controladores/accesoControlador.php';
let r = '../controladores/registroEgresadoControlador.php';
$(document).ready(function(){
    LlenarDepartamento();
});
function Acceso()
{
    let usuario=document.getElementById('usu').value;
    let contrasena=document.getElementById('pass').value;

    if(usuario=="")
    {
        mensaje("ERROR","Debe Ingresar el Usuario","error");
        return;
    } 
    if(contrasena=="")
    {
        mensaje("ERROR","Debe Ingresar el Password","error");
        return;
    } 

    $.ajax({
        data:{usuario:usuario,contrasena:contrasena},
        url:ruta,
        type:'post',
        dataType:'json',

        success:function(data)
        { 
            if(data=="OK")
            {
                window.location='home.php';
            }
            else
            {
                mensaje("ERROR",data,"error");
               /* document.getElementById('usu').value="";
                document.getElementById('pass').value="";*/
            }
        }
    })

}
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

function Registrar(){

    $.ajax({
        data: RetornarDatosMatriculado("AGREGAR_MATRICULA"),
        url: r,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AgregarEgresados').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}
function RetornarDatosMatriculado(accion) {
    return {
        dniusuario: document.getElementById('dniusuario').value,
        contrasena: document.getElementById('password').value,
        accion:accion
    }
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
function AgregarUsuario() {
    let formData = new FormData();
        let datosFormulario = RetornarDatosUsuario("NUEVO");
    for (let key in datosFormulario) {
        formData.append(key, datosFormulario[key]);
    }
        let fotoArchivo = document.getElementById('foto_archivo').files[0];
    if (fotoArchivo) {
        formData.append("foto_archivo", fotoArchivo);
    }

    $.ajax({
        url: r,  
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,  
        processData: false,  
        success: function(data) {
            if (data == "OK") {
                $('#AgregarEgresados').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                Limpiar();
            } else {
                MostrarAlerta("ALERTA", data, "error");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud:", error);
            MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
            Limpiar();
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

function mensaje(titulo,descripcion,icono)
{
    Swal.fire({
        position: "top-end",
        icon: icono,
        title: titulo,
        text:descripcion,
        background:'#181E36',  
        color:'#6592ff',              
        iconColor:'#6592ff',
        showConfirmButton: false,
        timer: 1500
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
