

function mostrarSeccion(seccion) {
    // Obtener todas las secciones
    var secciones = document.getElementsByClassName('seccion');

    // Ocultar todas las secciones
    for (var i = 0; i < secciones.length; i++) {
        secciones[i].classList.add('oculto');
    }

    // Mostrar la sección correspondiente al enlace clicado
    var seccionMostrada = document.getElementById(seccion);
    seccionMostrada.classList.remove('oculto');


}














