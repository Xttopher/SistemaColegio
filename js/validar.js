function validar(e, c, t, tipo) {
    let cad = c.val();
    if (e.keyCode == 13) {
        if (cad == "" || cad == null) {
            MostrarAlerta('ALERTA', 'Campo Obligatorio!', 'error');
        }
        else {
            if (tipo == "numero") expresion = /^[0-9]*$/;
            if (tipo == "letra") expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/;
            if (tipo == "correo") expresion = /^(\w+[\.-]?\w+)* @ (\w+[\.-]?\w+)*(\.\w{2,4})$/; 
            if (tipo == "decimal") expresion = /^[0-9]*$ | ^[0-9]*\.[0-9]{1,2}$/;
            if (tipo == "nota") expresion = /^[0-9]{1}$|^1[0-9]{1}|^20$/;
            if (tipo == "general") expresion = /^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ\.\s]*$/;
            if (expresion.test(cad)) {
                t.prop('disabled', false);
                t.focus();
            }
            else {
                MostrarAlerta('ALERTA', 'Debe Ingresar un valor valido!', 'error');
                c.val('');
            }
        }
    }
}
function combo(c, t) {
    let cad = c.val();
    if (cad != "" || cad != null) {
        $('#sol').prop('disabled', false);
        $('#cas').prop('disabled', false);
        t.prop('disabled', false);
        t.focus();
    }
}
/*function opcion(n) {
    if (cas.checked || sol.checked) {
        n.prop('disabled', false);
        n.focus();
    }
    if (t1.checked || t2.checked || t3.checked) {
        n.prop('disabled', false);
        n.focus();
    }
}*/
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
function ah(t) {
    if (t == 'si'){
        $('#r1').prop('disabled', false);
        $('#r2').prop('disabled', false); 
        $('#r3').prop('disabled', false); 
    }
    if (t == 'no'){
        $('#t1').prop('disabled', false);
        $('#t2').prop('disabled', false); 
        $('#t3').prop('disabled', false); 
    }
}
function limpiar() {
    block();
}
function limpiar2() {
    block('#c1');
    document.getElementById('c4').value = 'Seleccione su Especialidad';
    document.getElementById('c5').value = 'Seleccione su Curso';
}
function limpiar3() {
    block('#c1');
    document.getElementById('c3').value = 'Seleccione su Cargo';
}
function limpiar4() {
    block('#c1');
    document.getElementById('c5').value = 'Seleccione el Cargo';
}
function limpiar5() {
    block('#c1');
    document.getElementById('c5').value = 'Seleccione el Cargo';
}
function limpiar6() {
    block('#c1');
}
function block(value) {
    objetos(true);
    $(value).prop('disabled',false);
    $(value).focus();
}
function objetos(v) {
    let caja = document.getElementsByTagName('input');
    let combo = document.getElementsByTagName('select');

    for (i = 0; i < caja.length; i++) {
        caja[i].disabled = v;
        caja[i].checked != v;
        caja[i].value = "";
    }
    for (i = 0; i < combo.length; i++) {
        combo[i].disabled = v;
        combo[i].checked = v;
        combo[i].value = "";
    }
}


