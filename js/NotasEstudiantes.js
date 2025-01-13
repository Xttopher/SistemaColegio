var ruta = "../controladores/DocenteCursosControlador.php";
var ruta2 = "../controladores/CalificarNotasControlador.php";

$(document).ready(function () {
    llamar();
    LlenarPeriodos();
    LlenarNivelesDesempeño();
});
function llamar() {
    BUSCARPERSONA(document.getElementById('dniDocente').value);
}
function BUSCARPERSONA(id) {
    $.ajax({
        data: { DniDocente: id, accion: "CONSULTAR_DOCENTE" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('id_docente').value = data.id_docente;

        }
    })
}

function CargarNotasEstudiantesVer() {
    $("#dtNotasEstudiantes").dataTable().fnDestroy();
    $.ajax({
        data: Cargar_Alumnos("CARGAR_ESTUDIANTES"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<tr>";
                html += "<td>" + data.dni + "</td>";
                html += "<td>" + data.nombre_estudiante + "</td>";
                html += "<td>" + data.nombre_curso + "</td>";
                html += "<td>" + data.nombre_periodo + "</td>";
                html += "<td>" + data.nivel_1 + "</td>";
                html += "<td>" + data.nivel_2 + "</td>";
                html += "<td>" + data.nivel_3 + "</td>";
                html += "<td>" + data.nivel_4 + "</td>";
                html += "<td>" + data.nivel_5 + "</td>";
                html += "<td>" + data.nivel_6 + "</td>";
                html += "<td style='text-align:center;'>";
                html += "<button class='btn btn-dark mx-2' title='Editar' data-bs-toggle='modal' data-bs-target='#AsignarNotasEstudiantes' onclick='EstudianteUnico(" + data.id_matricula + ")'>NOTAS</button>";                
                html += "</td>";
                html += "</tr>";
            });
            document.getElementById('datos').innerHTML = html;
            grid();
        }
    });
}

function Cargar_Alumnos(accion) {
    return {
        id_curso_docente: document.getElementById('CursoS1').value,
        id_periodo: document.getElementById('peridoacademico').value,
        accion: accion
    };
}
function LlenarPeriodos() {
    $.ajax({
        data: { accion: "LLENAR_PERIODO" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value=" + data.id_periodo + ">" + data.nombre_periodo + "</option>";
            });
            document.getElementById('peridoacademico').innerHTML = html;
            LlenarCursosPorPeriodo();
        }

    })
}
function LlenarNivelesDesempeño() {
    $.ajax({
        data: { accion: "LLENAR_NIVELES_DESEMPEÑO" },
        url: ruta2,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value=" + data.id_nivel + ">" + data.descripcion + "</option>";
            });
            document.getElementById('nota1').innerHTML = html;
            document.getElementById('nota2').innerHTML = html;
            document.getElementById('nota3').innerHTML = html;
            document.getElementById('nota4').innerHTML = html;
            document.getElementById('nota5').innerHTML = html;
            document.getElementById('nota6').innerHTML = html;
            document.getElementById('notafinal1').innerHTML = html;
            document.getElementById('notafinal2').innerHTML = html;
            document.getElementById('notafinal3').innerHTML = html;
        }
    })
}
function AgregarNotas() {
    $.ajax({
        data: RetornarDatosNotas("AGREGAR_NOTAS_ESTUDIANTES"),
        url: ruta2,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == "OK") {
                $('#AsignarNotasEstudiantes').modal('toggle');
                MostrarAlerta("Éxito", "Datos Guardados con Éxito", "success");
                $("#dtNotasEstudiantes").dataTable().fnDestroy();
                CargarNotasEstudiantesVer();
            }
            else {
                MostrarAlerta("ALERTA", data, "error");
            }
        }
    })
}

function Curso_Docente(id) {
    $.ajax({
        data: { Curso_Docente: id, accion: "BUSCAR_CURSO_DOCENTE" },
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('cpt1').innerText = data.competencia_1;
        }
    })
}
function EstudianteUnico(id_matricula) {
    let curso_docente = document.getElementById('CursoS1').value;
    $.ajax({
        data: { id_matricula: id_matricula, id_curso_docente: curso_docente, accion: "SOLO_ESTUDIANTE" },
        url: ruta2,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            document.getElementById('matricula').value = data.codmatricula;
            document.getElementById('id_curso_profe').value = data.cursodocente;
            document.getElementById('nota1').value = data.nivel_1;
            document.getElementById('nota2').value = data.nivel_2;
            document.getElementById('nota3').value = data.nivel_3;
            document.getElementById('nota4').value = data.nivel_4;
            document.getElementById('nota5').value = data.nivel_5;
            document.getElementById('nota6').value = data.nivel_6;
            document.getElementById('notafinal1').value = data.nota_final_1;
            document.getElementById('notafinal2').value = data.nota_final_2;
            document.getElementById('notafinal3').value = data.nota_final_3;
            document.getElementById('comentario1').value = data.comentario;
            document.getElementById('comentario2').value = data.comentario2;
            document.getElementById('comentario3').value = data.comentario3;
        }
    })
}

function RetornarDatosNotas(accion) {
    let n1 = document.getElementById('nota1').value;
    let n2 = document.getElementById('nota2').value;
    let n3 = document.getElementById('nota3').value;
    let n4 = document.getElementById('nota4').value;
    let n5 = document.getElementById('nota5').value;
    let n6 = document.getElementById('nota6').value;
    let nf1 = document.getElementById('notafinal1').value;
    let nf2 = document.getElementById('notafinal2').value;
    let nf3 = document.getElementById('notafinal3').value;

    if(n1 == "")n1 = 6;if(n2 == "")n2 = 6;if(n3 == "")n3 = 6;
    if(n4 == "")n4 = 6;if(n5 == "")n5 = 6;if(n6 == "")n6 = 6;
    if(nf1 == "")nf1 = 6;if(nf2 == "")nf2 = 6;if(nf3 == "")nf3 = 6;
    return {
        nota1: n1,nota2: n2,  nota3: n3,
        nota4: n4,nota5: n5,nota6: n6,
        notafinal1: nf1,
        notafinal2: nf2,
        notafinal3: nf3,
        comentario: document.getElementById('comentario1').value,
        comentario2: document.getElementById('comentario2').value,
        comentario3: document.getElementById('comentario3').value,
        id_matricula: document.getElementById('matricula').value,
        id_curso_docente: document.getElementById('id_curso_profe').value,
        accion: accion
    };
}

function LlenarCursosPorPeriodo() {
    $.ajax({
        data: RetornarDatos("LLENAR_CURSOS_PERIODO"),
        url: ruta,
        type: 'post',
        dataType: 'json',
        success: function (data) {
            let html = "";
            $.each(data, function (index, data) {
                html += "<option value=" + data.id_curso_docente + ">" + data.nombre_curso + " - " + data.nombre_ciclo + " - " + data.nombre_programa + "</option>";
            });
            document.getElementById('CursoS1').innerHTML = html;
            CargarNotasEstudiantesVer();
            Curso_Docente(document.getElementById('CursoS1'));
        }
    })
}

function RetornarDatos(accion) {
    return {
        IdDocente: document.getElementById('id_docente').value,
        Periodo: document.getElementById('peridoacademico').value,
        accion: accion
    };
}
function MostrarAlerta(titulo, descripcion, tipoAlerta) {
    Swal.fire({
        title: titulo,
        text: descripcion,
        icon: tipoAlerta,
        confirmButtonColor: '#3085d6',
    });
}

function grid() {
    $('#dtNotasEstudiantes').dataTable({
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
