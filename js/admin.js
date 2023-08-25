

function agregarHorario(dia, hora_inicio, hora_fin, id_asignatura, id_nivel) {
    // URL del servicio web
    var url = "ws/serverAdmin.php";

    // Datos a enviar
    var data = {
        "action": "agregarHorario",
        "dia": dia,
        "hora_inicio": hora_inicio,
        "hora_fin": hora_fin,
        "id_asignatura": id_asignatura,
        "id_nivel": id_nivel
    };

    // Petición AJAX
    $.ajax({
        url: url,
        method: "POST",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            // Si se agrega correctamente
            console.log(response.message);
            // Actualiza la lista de horarios
            js_cargar_lista_usuarios('horarios');
        } else {
            // Si hay un error
            console.error(response.message);
        }
    }).always(function () {
        // Cerrar el modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalCrearHorario'));
        modal.hide();
    });
}


//funcion para mandar los datos del modal
function guardarNuevoHorario() {
    var dia = document.getElementById("dia2").value;
    var hora_inicio = document.getElementById("hora_inicio2").value;
    var hora_fin = document.getElementById("hora_fin2").value;
    var id_asignatura = document.getElementById("id_asignatura2").value;
    var id_nivel = document.getElementById("id_nivel2").value;

    agregarHorario(dia, hora_inicio, hora_fin, id_asignatura, id_nivel);
}



//abrir modal de horario
function abrirModalCrearHorario() {
    var myModal = new bootstrap.Modal(document.getElementById('modalCrearHorario'), {});
    myModal.show();
}

//peticion para borrar horario
function borrarHorario(id_horario) {
    if (window.confirm("¿Está seguro de que desea eliminar este horario?")) {
        //url
        var url = "ws/serverAdmin.php";
        //datos
        var data = {
            "action": "borrarHorario",
            "id_horario": id_horario
        };
        //peticion ajax
        $.ajax({
            url: url,
            method: "DELETE",
            data: {'data': JSON.stringify(data)},
            dataType: "json",
        }).done(function (response) {
            if (response.status === 'success') {
                //si se ejecuta se actualiza
                console.log(response.message);
                js_cargar_lista_usuarios('horarios');
            } else {
                console.error(response.message);
            }
        });
    }
    return false;
}
//peticion para editar el horario
function editar_horario(id_horario, dia, hora_inicio, hora_fin, id_asignatura, id_nivel) {
    //url
    var url = "ws/serverAdmin.php";
    //datos a mandar
    var data = {
        "action": "editarHorario",
        "id_horario": id_horario,
        "dia": dia,
        "hora_inicio": hora_inicio,
        "hora_fin": hora_fin,
        "id_asignatura": id_asignatura,
        "id_nivel": id_nivel
    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            //actualizar la tabla
            js_cargar_lista_usuarios('horarios');
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarHorario'));
        modal.hide();
    });
}
//ontener datos para editarlos
function editarHorario(id_horario, dia, hora_inicio, hora_fin, id_asignatura, id_nivel) {
    // Asignar los valores a los campos del formulario
    document.getElementById('id_horario').value = id_horario;
    document.getElementById('dia').value = dia;
    document.getElementById('hora_inicio').value = hora_inicio;
    document.getElementById('hora_fin').value = hora_fin;
    document.getElementById('id_asignatura').value = id_asignatura;
    document.getElementById('id_nivel').value = id_nivel;

    // Abrir el modal
    var myModal = new bootstrap.Modal(document.getElementById('modalEditarHorario'), {});
    myModal.show();
}
//funcion para mandar los datos editados
function guardarEdicionHorario() {
    id_horario = document.getElementById('id_horario').value;
    dia = document.getElementById('dia').value;
    hora_inicio = document.getElementById('hora_inicio').value;
    hora_fin = document.getElementById('hora_fin').value;
    id_asignatura = document.getElementById('id_asignatura').value;
    id_nivel = document.getElementById('id_nivel').value;

    editar_horario(id_horario, dia, hora_inicio, hora_fin, id_asignatura, id_nivel);
}
//peticion para crear relacion apdres alumnos
function agregarRelacionPadreAlumno(id_padre_relacion, id_alumno_relacion) {
    // URL del servicio web
    var url = "ws/serverAdmin.php";

    // Datos a enviar
    var data = {
        "action": "agregarRelacionPadreAlumno",
        "id_padre": id_padre_relacion,
        "id_alumno": id_alumno_relacion
    };

    // Petición AJAX
    $.ajax({
        url: url,
        method: "POST",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            // Si se agrega correctamente
            console.log(response.message);
            js_cargar_lista_usuarios('relacion')
        } else {
            // Si hay un error
            console.error(response.message);
        }
    }).always(function () {
        // Cerrar el modal
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarRelacion'));
        modal.hide();
    });
}

//funcion para mandar los datos de relacion
function submitAgregarRelacion() {
    var id_padre_relacion = document.getElementById("id_padre_add_relacion").value;
    var id_alumno_relacion = document.getElementById("id_alumno_add_relacion").value;

    agregarRelacionPadreAlumno(id_padre_relacion, id_alumno_relacion);
}
//abrir el modal de relacion
function abrirModalCrearRelacion() {
    var modal = new bootstrap.Modal(document.getElementById('modalAgregarRelacion'));
    modal.show();
}

//peticion para borrar matricula
function borrarAlumnoAsignatura(id_matricula) {
    if (window.confirm("¿Está seguro de que desea eliminar esta matricula?")) {
        //url
        var url = "ws/serverAdmin.php";
        //definir datos
        var data = {
            "action": "borrarMatricula",
            "id_matricula": id_matricula
        };
        //peticion ajax
        $.ajax({
            url: url,
            method: "DELETE",
            data: {'data': JSON.stringify(data)},
            dataType: "json",
        }).done(function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                //si se borra actualiza lista
                js_cargar_lista_usuarios('matricula');
            } else {
                console.error(response.message);
            }
        });
    }
    return false;


}


function agregarMatricula(id_alumno, id_asignatura) {
    //url
    var url = "ws/serverAdmin.php";

    // Datos a enviar
    var data = {
        "action": "agregarMatricula",
        "id_alumno": id_alumno,
        "id_asignatura": id_asignatura
    };

    // Petición AJAX y configuraciones
    $.ajax({
        url: url,
        method: "POST",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            //actualizar tabla
            js_cargar_lista_usuarios('matricula')

        } else {
            console.error(response.message);
        }
    }).always(function () {
        // Cerrar el modal después de completar la acción
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarMatricula'));
        modal.hide();
    });
}


//funcion para mandar cambios en matricula
function submitAgregarMatricula() {
    var id_alumno = document.getElementById("id_alumno_add").value;
    var id_asignatura = document.getElementById("id_asignatura_add").value;

    agregarMatricula(id_alumno, id_asignatura);
}
//abrir modal para agregar matricula
function abrirModalCrearMatricula() {
    var modal = new bootstrap.Modal(document.getElementById('modalAgregarMatricula'));
    modal.show();
}


//peticion para borrar alumnos
function eliminarAlumno(id_alumno) {
    if (window.confirm("¿Está seguro de que desea eliminar este usuario?")) {
        //url
        var url = "ws/serverAdmin.php";
        //datos a mandar
        var data = {
            "action": "borrarAlumno",
            "id_alumno": id_alumno
        };
        //peticion ajax
        $.ajax({
            url: url,
            method: "DELETE",
            data: {'data': JSON.stringify(data)},
            dataType: "json",
        }).done(function (response) {
            if (response.status === 'success') {
                //actualizar tabla
                console.log(response.message);
                js_cargar_lista_usuarios('padres');
            } else {
                console.error(response.message);
            }
        });
    }
    return false;
}


//funcion para editar alumnos
function editAlumno2(id, login, contrasena, nombre, apellido, nivel, cedula, estado) {
    var url = "ws/serverAdmin.php"; // url
    //datos a mandar
    var data = {
        "action": "editarAlumno2",
        "id": id,
        "login": login,
        "contrasena": contrasena,
        "nombre": nombre,
        "apellido": apellido,
        "nivel": nivel,
        "cedula": cedula,
        "estado": estado
    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            //actualizar la lista
            js_cargar_lista_usuarios('alumnos');
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarAlumno2'));
        modal.hide();
    });
}

//funcion para mandar datos editados alumnos
function submitEditAlumno2() {
    var id = document.getElementById('id_alumno_edit2').value;
    var login = document.getElementById('login_alumno_edit2').value;
    var contrasena = document.getElementById('contrasena_alumno_edit2').value;
    var nombre = document.getElementById('nombre_alumno_edit2').value;
    var apellido = document.getElementById('apellido_alumno_edit2').value;
    var nivel = document.getElementById('nivel_alumno_edit2').value;
    var cedula = document.getElementById('cedula_alumno_edit2').value;
    var estado = document.getElementById('estado_alumno_edit2').value;
    editAlumno2(id, login, contrasena, nombre, apellido, nivel, cedula, estado);
}

//cargar datos de alumnos
function loadEditAlumnoData2(id_alumno, login, nombre, apellidos, id_nivel, cedula_alumno, estado) {
    document.getElementById('id_alumno_edit2').value = id_alumno;
    document.getElementById('login_alumno_edit2').value = login;
    document.getElementById('contrasena_alumno_edit2').value = null;
    document.getElementById('nombre_alumno_edit2').value = nombre;
    document.getElementById('apellido_alumno_edit2').value = apellidos;
    document.getElementById('nivel_alumno_edit2').value = id_nivel;
    document.getElementById('cedula_alumno_edit2').value = cedula_alumno;
    document.getElementById('estado_alumno_edit2').value = estado;

    // Mostrando el modal
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAlumno2'));
    modal.show();
}
//peticion para borrar padre
function eliminarPadre(id_padre) {
    if (window.confirm("¿Está seguro de que desea eliminar este usuario?")) {
        //url
        var url = "ws/serverAdmin.php";
        //data a manadar
        var data = {    
            "action": "borrarPadre",
            "id_padre": id_padre
        };
        //peticion ajax
        $.ajax({
            url: url,
            method: "DELETE",
            data: {'data': JSON.stringify(data)},
            dataType: "json",
        }).done(function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                //actualizar lista
                js_cargar_lista_usuarios('padres');
            } else {
                console.error(response.message);
            }
        });
    }
    return false;
}
//submit para mandar datos editados
function submitEditPadre2() {
    // Obtener los datos del formulario
    var id = document.getElementById('id_padre_edit2').value;
    var nombre = document.getElementById('nombre_padre_edit2').value;
    var apellido = document.getElementById('apellido_padre_edit2').value;
    var cedula = document.getElementById('cedula_padre_edit2').value;
    var correo = document.getElementById('correo_padres_edit2').value;
    var login = document.getElementById('login_padre_edit2').value;
    var contrasena = document.getElementById('contrasena_padre_edit2').value;
    var estado = document.getElementById('estado_padre_edit2').value;

    edit_padre2(id, nombre, apellido, cedula, correo, login, contrasena, estado);

}
//peticion para editar padre
function edit_padre2(id, nombre, apellido, cedula, correo, login, contrasena, estado) {
    var url = "ws/serverAdmin.php"; // url
    //data a mandar
    var data = {
        "action": "editarPadre2",
        "id": id,
        "nombre": nombre,
        "apellido": apellido,
        "cedula": cedula,
        "correo": correo,
        "login": login,
        "contrasena": contrasena,
        "estado": estado

    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            // actualizar lista
            js_cargar_lista_usuarios('padres');
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarPadre2'));
        modal.hide();
    });
}
//cargar datos de los padres en los campos
function loadEditPadreData2(id_padre, nombre, apellidos, cedula_padre, correo_padres, login, estado) {
    // Cargando los datos en los campos del modal
    document.getElementById('id_padre_edit2').value = id_padre;
    document.getElementById('nombre_padre_edit2').value = nombre;
    document.getElementById('apellido_padre_edit2').value = apellidos;
    document.getElementById('cedula_padre_edit2').value = cedula_padre;
    document.getElementById('correo_padres_edit2').value = correo_padres;
    document.getElementById('login_padre_edit2').value = login;
    document.getElementById('contrasena_padre_edit2').value = null;
    document.getElementById('estado_padre_edit2').value = estado;

    // Mostrando el modal
    var modal = new bootstrap.Modal(document.getElementById('modalEditarPadre2'));
    modal.show();
}

//funcion para agregar profes
function agregar_profe(login, contraseña, nombre_profe, apellido, email, especialista, nombre_asignatura) {
    var url = "ws/serverAdmin.php"; // url
    //datos a mandar
    var data = {
        "action": "agregarProfesor",
        "login": login,
        "contraseña": contraseña,
        "nombre_profe": nombre_profe,
        "apellido": apellido,
        "email": email,
        "especialista": especialista,
        "nombre_asignatura": nombre_asignatura
    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "POST",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            js_cargar_lista_usuarios('profesores'); // Recarga la lista
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarProfe'));
        modal.hide();
    });
}



//funcion para agregar profe
function submitAgregarProfe() {
    // Se obtienen los valores
    var login_profesor = document.getElementById('login_add').value;
    var contrasena_profesor = document.getElementById('contraseña_add').value;
    var nombre_profe = document.getElementById('nombre_profe_add').value;
    var apellido_profesor = document.getElementById('apellido_add').value;
    var email_profesor = document.getElementById('email_add').value;
    var especialista_profesor = document.getElementById('especialista_add').value;
    var nombre_asignatura_profesor = document.getElementById('nombre_asignatura_add').value;

    // Llama a la función que realiza la petición AJAX para agregar los datos
    agregar_profe(login_profesor, contrasena_profesor, nombre_profe, apellido_profesor, email_profesor, especialista_profesor, nombre_asignatura_profesor);
}


//abrir modal agregar profe
function abrirModalAgregarProfe() {
    // Muestra el formulario
    var modal = new bootstrap.Modal(document.getElementById('modalAgregarProfe'));
    modal.show();
}

//peticion eliminar profe 
function eliminarProfe(id_profe) {
    if (window.confirm("¿Está seguro de que desea eliminar este usuario?")) {
        var url = "ws/serverAdmin.php";//url
        //datos a mandar
        var data = {
            "action": "borrarProfe",
            "id_profe": id_profe
        };
        //peticion ajax
        $.ajax({
            url: url,
            method: "DELETE",
            data: {'data': JSON.stringify(data)},
            dataType: "json",
        }).done(function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                js_cargar_lista_usuarios('profesores'); // Recarga la lista
            } else {
                console.error(response.message);
            }
        });
    }
    return false;
}




//peticion editar profe
function edit_profe(id_profesor, login, contraseña, nombre_profe, apellido, email, especialista, nombre_asignatura, id_asignatura_edit2) {
    var url = "ws/serverAdmin.php"; //url
    //datos a mandar
    var data = {
        "action": "editarProfesor",
        "id_profesor": id_profesor,
        "login": login,
        "contraseña": contraseña,
        "nombre_profe": nombre_profe,
        "apellido": apellido,
        "email": email,
        "especialista": especialista,
        "nombre_asignatura": nombre_asignatura,
        "id_asignatura_edit2": id_asignatura_edit2
    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            // actualizar lista
            js_cargar_lista_usuarios('profesores');
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarProfe'));
        modal.hide();
    });
}


//funcion para mandar datos de edicion de profesores
function submitEditProfe() {
    // Se obtienen los valores
    var id_profesor_editado = document.getElementById('id_profesor_edit').value;
    var login_profesor_editado = document.getElementById('login_edit').value;
    var contrasena_profesor_editado = document.getElementById('contraseña_edit').value;
    var nombre_profe_profesor_editado = document.getElementById('nombre_edit').value;
    var apellido_profesor_editado = document.getElementById('apellido_edit').value;
    var email_profesor_editado = document.getElementById('email_edit').value;
    var especialista_profesor_editado = document.getElementById('especialista_edit').value;
    var nombre_asignatura_profesor_editado = document.getElementById('nombre_asignatura_edit2').value;
    var id_asignatura_edit2 = document.getElementById('id_asignatura_edit2').value;

    // Llama a la función que realiza la petición AJAX para actualizar los datos
    edit_profe(id_profesor_editado, login_profesor_editado, contrasena_profesor_editado, nombre_profe_profesor_editado, apellido_profesor_editado
            , email_profesor_editado, especialista_profesor_editado, nombre_asignatura_profesor_editado, id_asignatura_edit2);
}

//cargar datos edicion profesores
function loadEditProfeData(id_profesor, login, nombre_profe, apellido, email, especialista, id_asignatura, nombre_asignatura) {
    console.log(nombre_asignatura);
    document.getElementById('id_profesor_edit').value = id_profesor;
    document.getElementById('login_edit').value = login;
    document.getElementById('nombre_edit').value = nombre_profe;
    document.getElementById('apellido_edit').value = apellido;
    document.getElementById('email_edit').value = email; // Asegúrate de tener este campo en tu modal
    document.getElementById('especialista_edit').value = especialista;
    document.getElementById('nombre_asignatura_edit2').value = nombre_asignatura;
    document.getElementById('id_asignatura_edit2').value = id_asignatura;
    document.getElementById('contraseña_edit').value = null;
    
    //abrir modal
    var modal = new bootstrap.Modal(document.getElementById('modalEditarProfe'));
    modal.show();
}

//funcion editar padre
function edit_padre(id_padre, nombreP, estadoPa) {
    var url = "ws/serverAdmin.php"; // URL
    //datos a mandar
    var data = {
        "action": "editarPadre",
        "id_padre": id_padre,
        "nombre": nombreP,
        "estado": estadoPa
    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            js_cargar_lista_usuarios('padrespen');//recargar lista
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarPadre'));
        modal.hide();
    });
}


//mandar datos para editar
function submitEditPadre() {
    // Se obtienen los valores
    var id_padre = document.getElementById('id_padre_edit').value;
    var nombreP = document.getElementById('nombre_padre_edit').value; // Obtén este valor
    var estadoPa = document.getElementById('estado_padre_edit').value; // Obtén este valor

    // Llama a la función que realiza la petición AJAX para actualizar los datos
    edit_padre(id_padre, nombreP, estadoPa);
}

//cargar datos a editar
function loadEditPadreData(id_padre, nombre, estado) {
    document.getElementById('id_padre_edit').value = id_padre;
    document.getElementById('nombre_padre_edit').value = nombre;
    document.getElementById('estado_padre_edit').value = estado; // Asegúrate de tener este campo en tu modal

    var modal = new bootstrap.Modal(document.getElementById('modalEditarPadre'));
    modal.show();
}


//peticion editar alumno
function edit_alumno(id_alumno, id_nivel, estado) {
    var url = "ws/serverAdmin.php";//url
    //datos a mandar
    var data = {
        "action": "editarAlumno",
        "id_alumno": id_alumno,
        "id_nivel": id_nivel,
        "estado": estado
    };
    //peticion ajax
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            console.log(response.message);
            js_cargar_lista_usuarios('alumnospen');//recargar la lista
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarAlumno'));
        modal.hide();
    });
}

//cargar data de alumnos en el modal
function loadEditAlumnoData(id_alumno, nombre, id_nivel, estado) {
    // Asignar los valores al formulario del modal
    document.getElementById('id_alumno_edit').value = id_alumno;
    document.getElementById('nombre_alumno_edit').value = nombre;
    document.getElementById('id_nivel_edit').value = id_nivel; // Asegúrate de tener un campo con este ID
    document.getElementById('estado_edit').value = estado; // Asegúrate de tener un campo con este ID

    // Muestra el formulario (modal)
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAlumno'));
    modal.show();
}
//mandar data de alumnos
function submitEditAlumno() {
    // Se obtienen los valores
    var id_alumno = document.getElementById('id_alumno_edit').value;
    var id_nivel = document.getElementById('id_nivel_edit').value; // Obtén este valor
    var estado = document.getElementById('estado_edit').value; // Obtén este valor

    // Llama a la función que realiza la petición AJAX para actualizar los datos
    edit_alumno(id_alumno, id_nivel, estado);
}


// Función para agregar asignaturas
function agregar_asignatura(nombre) {
    // Datos a mandar
    var url = "ws/serverAdmin.php";

    var data = {
        "action": "agregarAsignatura",
        "nombre": nombre
    };

    // Petición ajax y sus configuraciones
    $.ajax({
        url: url,
        method: "POST",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            // Si funciona
            console.log(response.message);
            js_cargar_lista_usuarios('asignaturas');
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarAsignatura'));
        modal.hide();
    });
}


// Función para mandar los cambios
function submitAgregarAsignatura() {
    // Se obtienen los valores 
    var nombre = document.getElementById('nombre_asignatura_add').value;

    // Se llama y se mandan los valores
    agregar_asignatura(nombre);
}


function abrirModalAgregarAsignatura() {
    // Puedes limpiar los campos del modal aquí, si es necesario
    document.getElementById('nombre_asignatura_add').value = '';

    // Muestra el formulario
    var modal = new bootstrap.Modal(document.getElementById('modalAgregarAsignatura'));
    modal.show();
}




//funcion eliminar asignatura
function eliminarAsignatura(id_asignatura) {
    if (window.confirm("¿Está seguro de que desea eliminar esta asignatura?")) {
        var url = "ws/serverAdmin.php";//url
        //datos a mandar
        var data = {
            "action": "borrarAsignatura",
            "id_asignatura": id_asignatura
        };
        //peticion ajax
        $.ajax({
            url: url,
            method: "DELETE",
            data: {'data': JSON.stringify(data)},
            dataType: "json",
        }).done(function (response) {
            if (response.status === 'success') {
                console.log(response.message);
                js_cargar_lista_usuarios('asignaturas'); // Recarga la lista
            } else {
                console.error(response.message);
            }
        });
    }
    return false;
}


// Función para editar asignaturas
function edit_asignatura(id_asignatura, nombre) {
    // Datos a mandar
    var url = "ws/serverAdmin.php";

    var data = {
        "action": "editarAsignatura",
        "id_asignatura": id_asignatura,
        "nombre": nombre
    };

    // Petición ajax y sus configuraciones
    $.ajax({
        url: url,
        method: "PUT",
        data: {'data': JSON.stringify(data)},
        dataType: "json",
    }).done(function (response) {
        if (response.status === 'success') {
            // Si funciona
            console.log(response.message);
            js_cargar_lista_usuarios('asignaturas');//recargar lista
        } else {
            console.error(response.message);
        }
    }).always(function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById('modalEditarAsignatura'));
        modal.hide();
    });
}

// Función para mandar los cambios
function submitEditAsignatura() {
    // Se obtienen los valores 
    var id_asignatura = document.getElementById('id_asignatura_edit').value;
    var nombre = document.getElementById('nombre_asignatura_edit').value;

    // Se llama y se mandan los valores
    edit_asignatura(id_asignatura, nombre);
}

//cargar datos en el modal de asignatura
function loadEditAsignaturaData(id_asignatura, nombre) {
    document.getElementById('id_asignatura_edit').value = id_asignatura;
    document.getElementById('nombre_asignatura_edit').value = nombre;

    // Muestra el formulario
    var modal = new bootstrap.Modal(document.getElementById('modalEditarAsignatura'));
    modal.show();
}
//funcion para cargar todos los datos
function js_cargar_lista_usuarios(action) {
    //url
    var url = "ws/serverAdmin.php?action=";
    //obtener datos
    var tipo_usuario = document.body.getAttribute('data-tipo-usuario');
    // Concatenar el tipo de usuario a la acción
    url += action + "&tipo_usuario=" + tipo_usuario;

    switch (action) {
        case 'asignaturas':
            url += 'asignaturas';
            break;
        case 'alumnospen':
            url += 'alumnospen';
            break;
        case 'padrespen':
            url += 'padrespen';
            break;
        case 'profesores':
            url += 'profesores';
            break;
        case 'padres':
            url += 'padres';
            break;
        case 'alumnos':
            url += 'alumnos';
            break;
        case 'matricula':
            url += 'matricula';
            break;
        case 'relacion':
            url += 'relacion';
            break;
        case 'horarios':
            url += 'horarios';
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

    //zona para forzar cierre de modals
    $(document).ready(function () {
        $('#modalEditarAsignatura').on('hidden.bs.modal', function (e) {
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
        $('#modalAgregarMatricula').on('hidden.bs.modal', function (e) {
            $(".modal-backdrop").remove();
            $('body').css('overflow', 'auto'); 
        });
        $('#modalCrearHorario').on('hidden.bs.modal', function (e) {
            $(".modal-backdrop").remove();
            $('body').css('overflow', 'auto'); 
        });


    });
}

