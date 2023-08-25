//carga el id para poner notas
function loadAddNotaData(id_alumno) {
    document.getElementById('id_alumno_nueva_nota').value = id_alumno;
    // Configura otros valores en el modal según sea necesario
    var modal = new bootstrap.Modal(document.getElementById('modalAgregarNota'));
    modal.show();
}



//funcion para enviar nueva nota
function submitNewNota() {
    //obtenemos datos
    var nota = document.getElementById('nueva_nota').value;
    var trimestre = document.getElementById('nuevo_trimestre').value;
    var id_alumno = document.getElementById('id_alumno_nueva_nota').value;

    //llamar a la funcion addnota
    addNota(nota, trimestre, id_alumno);
}
//añadir nota
function addNota(nota, trimestre, id_alumno) {
    //datos a mandar
    var url = "ws/serverProfes.php";
    var data = {
        "action": "add_nota",
        "nota": nota,
        "trimestre": trimestre,
        "id_alumno": id_alumno
    };
    //funcion ajax y su config
    $.ajax({
        url: url,
        method: "POST",
        data: JSON.stringify(data), 
        contentType: "application/json", 
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            //si funciona
            console.log(response.message);
            js_cargar_lista_usuarios("get_notas");
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarNota'));
        modal.hide();
    });

}

//cargar datos para editar
function loadEditNotaData(id_nota, nota, trimestre) {
    document.getElementById('id_nota_edit').value = id_nota; 
    document.getElementById('nota_edit').value = nota;      
    document.getElementById('trimestre_edit').value = trimestre; 


    // Mostrar el form
    var modal = new bootstrap.Modal(document.getElementById('modalEditarNota'));
    modal.show();
}
//funcion enviar cambios nota
function submitEditNota() {
    // obtiene los valores a cambiar
    var id_nota = document.getElementById('id_nota_edit').value;
    var nota = document.getElementById('nota_edit').value;
    var trimestre = document.getElementById('trimestre_edit').value;
    //llama a otra funcion
    edit_nota(id_nota, nota, trimestre);
}
//funcion editar notas
function edit_nota(id_nota, nota, trimestre) {
    //datos a mandar
    var url = "ws/serverProfes.php";

    var data = {
        "action": "edit_nota",
        "id_nota": id_nota,
        "nota": nota,
        "trimestre": trimestre
    };
    //peticion ajax y sus configs
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            //si funciona
            console.log(response.message);
            js_cargar_lista_usuarios('get_notas'); 
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarNota'));
        modal.hide();
    });
}

//funcion para editar faltas
function edit_falta(id_falta, fecha, justificada) {
    //datos a mandar
    var url = "ws/serverProfes.php";

    var data = {
        "action": "edit_falta",
        "id_falta": id_falta,
        "fecha": fecha,
        "justificada": justificada
    };
    //peticion ajax y sus configs
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
        
        
    }).done(function (response) {
        if (response.status === 'success') {
            //si funciona
            console.log(response.message);


            js_cargar_lista_usuarios('faltas');
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarFalta'));
        modal.hide();
    });
}

//funcion para mandar los cambios
function submitEditFalta() {
    // se obtienen los valores 
    var id_falta = document.getElementById('id_falta_edit').value;
    var fecha = document.getElementById('fecha_edit').value;
    var justificada = document.getElementById('justificada_edit').value;

    // se llama y se mandan los valores
    edit_falta(id_falta, fecha, justificada);


}

//obtiene el id para agregar faltas
function loadFaltaData(id_alumno) {
    document.getElementById('id_alumno_nueva_falta').value = id_alumno;
    
    var modal = new bootstrap.Modal(document.getElementById('modalFalta'));
    modal.show();
}

//carga los datos en los campos
function loadEditFaltaData(id_falta, fecha, justificada) {
    document.getElementById('id_falta_edit').value = id_falta;
    document.getElementById('fecha_edit').value = fecha;
    document.getElementById('justificada_edit').value = justificada;

    // Muestra el formulario
    var modal = new bootstrap.Modal(document.getElementById('modalEditarFalta'));
    modal.show();
}


//agregar falta
function submitFalta() {
    //obtener valores 
    var id_alumno = document.getElementById('id_alumno_nueva_falta').value;
    var fecha = document.getElementById('fecha').value;
    var justificada = document.getElementById('justificada').value;

    // Llama a la función add_falta con estos valores
    add_falta(id_alumno, fecha, justificada);
    //ocultar modal
    var modal = bootstrap.Modal.getInstance(document.getElementById('modalFalta'));
    modal.hide();
}


//funcion añadir falta
function add_falta(id_alumno, fecha, justificada) {
    //parametros y datos
    var url = "ws/serverProfes.php";

    var data = {
        "action": "add_falta",
        "id_alumno": id_alumno,
        "fecha": fecha,
        "justificada": justificada
    };
    //peticion ajax y su config
    $.ajax({
        url: url,
        method: "POST",
        data: JSON.stringify(data),
        contentType: "application/json",
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            //si funciona
             js_cargar_lista_usuarios('faltas');
         
        } else {
            console.error(response.message);
        }
    });
}
//funcion cargar usuarios o distinta info
function js_cargar_lista_usuarios(action, id_asignatura) {
    //obtener datos
    var url = "ws/serverProfes.php?action=";

    var tipo_usuario = document.body.getAttribute('data-tipo-usuario');
    // Concatenar el tipo de usuario a la acción
    url += action + "&tipo_usuario=" + tipo_usuario;

    switch (action) {
        case 'alumnos':   
            url += '&id_asignatura=' + id_asignatura;
            break;
        case 'profesores': 
            break;
        case 'faltas': 
            break;
        case 'get_notas': 

            break;
        default:
            console.error('Action not valid: ', action);
            return;
    }
    //creacion de datos
    var settings = {
        "url": url,
        "method": "GET",
        "timeout": 0
    };
    //peticion ajax
    $.ajax(settings).done(function (response) {
        $("#contenedor").html(response);
        if (action === 'notas') { 
            displayNotas(JSON.parse(response));
        }
    });
}

//funcion para actualizar tablas
function js_limpiar_lista_usuarios() {
    $("#contenedor").html('');

}
//funcion encargada de ocultar los modals de forma correcta
$(document).ready(function () {
    $('#modalEditarFalta').on('hidden.bs.modal', function (e) {
        $(".modal-backdrop").remove();
        $('body').css('overflow', 'auto'); 
    });
    $('#modalEditarNota').on('hidden.bs.modal', function (e) {
        $(".modal-backdrop").remove();
        $('body').css('overflow', 'auto'); 
    });
    
    $('#modalAgregarNota').on('hidden.bs.modal', function (e) {
        $(".modal-backdrop").remove();
        $('body').css('overflow', 'auto'); 
    });
    
    $('#modalFalta').on('hidden.bs.modal', function (e) {
        $(".modal-backdrop").remove();
        $('body').css('overflow', 'auto'); 
    });
    
    
});

