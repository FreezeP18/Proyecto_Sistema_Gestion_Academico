//funcion encargada de los gets
function js_cargar_lista_usuarios(action, id_asignatura) {
    //asignar datos y parametros segun su necesidad
    var url = "ws/serverEstudiantes_Padres.php?action=";
    
    var tipo_usuario = document.body.getAttribute('data-tipo-usuario');
      // Concatenar el tipo de usuario a la acción
    url += action + "&tipo_usuario=" + tipo_usuario;
    //determinar el tipo de accion que solicita el usser
    switch (action) {
        case 'horario':
            break;
        case 'estudiantes':
            break;
        case 'profesores':
            break;
        case 'notas':
            url += '&id_asignatura=' + id_asignatura;
            break;
        case 'asignaturas':
            break;
        case 'asistencia':  
            url += '&id_asignatura=' + id_asignatura;
            break;
        default:
            console.error('Action not valid: ', action);
            return;
    }
    //config a usar
    var settings = {
        "url": url,
        "method": "GET",
        "timeout": 0
    };
    //peticion ajax
    $.ajax(settings).done(function (response) {
        $("#contenedor").html(response);
    });
}
//actualiza las tablas
function js_limpiar_lista_usuarios(){
   $("#contenedor").html('');  
    
}