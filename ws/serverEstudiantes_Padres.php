<?php

//se inicia la session
session_start();
//conexiones necesarias
require_once '../conn/conn.php';
$tipo = $_SERVER['REQUEST_METHOD'];
//switch para determinar la accion get
switch ($tipo) {
    case 'GET':
        if ($_GET['action'] == 'horario') {
            fn_ejecuta_get_horario();
        } else if ($_GET['action'] == 'estudiantes') {
            fn_ejecuta_get_estudiantes();
        } else if ($_GET['action'] == 'asignaturas') {
            fn_ejecuta_get_asignaturas();
        } else if ($_GET['action'] == 'profesores') {
            fn_ejecuta_get_profesores();
        } else if ($_GET['action'] == 'notas') {
            fn_ejecuta_get_notas();
        } else if ($_GET['action'] == 'asistencia') {
            fn_ejecuta_get_detalleAsistencia();
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    default:
        header("HTTP/1.1 405 method not allowed");
        header("allow: GET");
        break;
}

//funcion detalles de asistencia
function fn_ejecuta_get_detalleAsistencia() {
    //obtener datos
    header("HTTP/1.1 200 successful");

    $tipo_usuario = $_GET['tipo_usuario'];
    $id_usuario;
    $tabla;
    //determinar si es padre o hijo
    if ($tipo_usuario == "padres") {
        $id_usuario = $_SESSION['id_padre'];
        $tabla = "Padre";
    } else {
        $id_usuario = $_SESSION['id_alumno'];
        $tabla = "Alumno";
    }

    $id_asignatura = $_GET['id_asignatura'];
    //conectar a la base de datos
    $db = new connection();
    $db->conectar();
    //ejecutar el sql segun el tipo de usuario
    if ($tabla == "Alumno") {
        $sql = "SELECT fecha, justificada, A.nombre AS asignatura
            FROM Falta_Asistencia FA
            INNER JOIN Asignatura A ON FA.id_asignatura = A.id_asignatura
            WHERE FA.id_alumno = $id_usuario";
    } else if ($tabla == "Padre") {

        $sql = "SELECT FA.fecha, FA.justificada, ASI.nombre AS asignatura 
            FROM Falta_Asistencia FA
            INNER JOIN relacion_padres_alumno RPA ON FA.id_alumno = RPA.id_alumno
            INNER JOIN Asignatura ASI ON FA.id_asignatura = ASI.id_asignatura
            WHERE RPA.id_padre = $id_usuario ";
    }

    $rs = $db->ejecutarSql($sql);
    //crear la tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Fecha</th>';
    $tabla .= '         <th scope="col">Justificada</th>';
    $tabla .= '         <th scope="col">Asignatura</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //llenar la tabla
    while ($fila = mysqli_fetch_assoc($rs)) {
        $tabla .= '         <tr>';
        $tabla .= '           <td>' . $fila['fecha'] . '</td>';
        $tabla .= '           <td>' . ($fila['justificada'] == 1 ? 'Sí' : 'No') . '</td>';
        $tabla .= '           <td>' . $fila['asignatura'] . '</td>';
        $tabla .= '         </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' <table>';

    echo $tabla;
    $db->desconectar();
    exit;
}

//funcion para obetener las notas
function fn_ejecuta_get_notas() {
    //obtener datos
    header("HTTP/1.1 200 successful");
    $tipo_usuario = $_GET['tipo_usuario'];
    $id_usuario;
    $tabla;
    //si es padre o alumno
    if ($tipo_usuario == "padres") {
        $id_usuario = $_SESSION['id_padre'];
        $tabla = "Padre";
    } else {
        $id_usuario = $_SESSION['id_alumno'];
        $tabla = "Alumno";
    }

    $id_asignatura = $_GET['id_asignatura'];
    //conectar a la base de datos
    $db = new connection();
    $db->conectar();
    //elegir segun si es padre o hijo
    if ($tabla == "Alumno") {
        $sql = "SELECT N.trimestre, N.valor 
                FROM Nota N
                WHERE N.id_alumno = $id_usuario AND N.id_asignatura = $id_asignatura";
    } else if ($tabla == "Padre") {
        // Asumiendo que la tabla Padre-Alumno tiene campos id_padre e id_alumno
        $sql = "SELECT N.trimestre, N.valor 
                FROM Nota N
                INNER JOIN relacion_padres_alumno RPA ON N.id_alumno = RPA.id_alumno
                WHERE RPA.id_padre = $id_usuario AND N.id_asignatura = $id_asignatura";
    }

    $rs = $db->ejecutarSql($sql);
    //crear la tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Trimestre</th>';
    $tabla .= '         <th scope="col">Nota</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //llenar la tabla
    while ($fila = mysqli_fetch_assoc($rs)) {
        $tabla .= '         <tr>';
        $tabla .= '           <td>' . $fila['trimestre'] . '</td>';
        $tabla .= '           <td>' . $fila['valor'] . '</td>';
        $tabla .= '         </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' </table>';

    echo $tabla;
    $db->desconectar();
    exit;
}

//funcion obtener asignaturas
function fn_ejecuta_get_asignaturas() {
    //obtener datos
    header("HTTP/1.1 200 successful");

    $tipo_usuario = $_GET['tipo_usuario'];
    $id_usuario;
    $tabla;
    //determinar si es padre o hijo
    if ($tipo_usuario == "padres") {
        $id_usuario = $_SESSION['id_padre'];
        $tabla = "Padre";
    } else {
        $id_usuario = $_SESSION['id_alumno'];
        $tabla = "Alumno";
    }
    //conectar a la db
    $db = new connection();
    $db->conectar();
    //ejecutar el sql segun que caso
    if ($tabla == "Alumno") {
        $sql = "SELECT A.id_asignatura, A.nombre 
                FROM Asignatura A
                INNER JOIN Matricula M ON A.id_asignatura = M.id_asignatura
                WHERE M.id_alumno = $id_usuario";
    } else if ($tabla == "Padre") {
        $sql = "SELECT A.id_asignatura, A.nombre 
                FROM Asignatura A
                INNER JOIN Matricula M ON A.id_asignatura = M.id_asignatura
                INNER JOIN relacion_padres_alumno RPA ON M.id_alumno = RPA.id_alumno
                WHERE RPA.id_padre = $id_usuario";
    }

    $rs = $db->ejecutarSql($sql);
    //crear la tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Asignatura</th>';
    $tabla .= '         <th scope="col">Acción</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //llenar la tabla
    while ($fila = mysqli_fetch_assoc($rs)) {
        $tabla .= '         <tr>';
        $tabla .= '         <td>' . $fila['nombre'] . '</td>';
        $tabla .= '         <td><button onclick="js_cargar_lista_usuarios(\'notas\', ' . $fila['id_asignatura'] . ')">Ver notas</button></td>';
        $tabla .= '       </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' <table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

//funcion para obtener el horario
function fn_ejecuta_get_horario() {
    //obtenemos los datos
    header("HTTP/1.1 200 successful");

    $tipo_usuario = $_GET['tipo_usuario'];
    $id_usuario;
    $tabla;
    //conectamos a la db
    $db = new connection();
    $db->conectar();
    //se identifica el tipo de usuario
    if ($tipo_usuario == "padres") {
        $id_usuario = $_SESSION['id_padre'];
        $tabla = "Padre";

        // Obtener el id_nivel del hijo del padre
        $sql = "SELECT A.id_nivel
        FROM Alumno A
        INNER JOIN relacion_padres_alumno RPA ON A.id_alumno = RPA.id_alumno
        WHERE RPA.id_padre = $id_usuario";
        $rs = $db->ejecutarSql($sql);
        $id_nivel = mysqli_fetch_assoc($rs)['id_nivel'];
    } else {
        $id_nivel = $_SESSION['id_nivel'];
        $tabla = "Alumno";
        $id_usuario = $_SESSION['id_alumno'];
    }


    //realizar la consulta segun el tipo de usuario
    if ($tabla == "Alumno") {
        if ($tabla == "Alumno") {
            $sql = "SELECT H.dia, H.hora_inicio, H.hora_fin, A.nombre
            FROM Horario H
            INNER JOIN Asignatura A ON H.id_asignatura = A.id_asignatura
            INNER JOIN Matricula M ON A.id_asignatura = M.id_asignatura
            WHERE H.id_nivel = $id_nivel AND M.id_alumno = $id_usuario";
        }
    } else if ($tabla == "Padre") {
        
        $sql = "SELECT H.dia, H.hora_inicio, H.hora_fin, A.nombre
        FROM Horario H
        INNER JOIN Asignatura A ON H.id_asignatura = A.id_asignatura
        INNER JOIN Matricula M ON A.id_asignatura = M.id_asignatura
        INNER JOIN relacion_padres_alumno RPA ON M.id_alumno = RPA.id_alumno
        INNER JOIN Alumno AL ON RPA.id_alumno = AL.id_alumno
        WHERE RPA.id_padre = $id_usuario AND H.id_nivel = $id_nivel";
    }



    $rs = $db->ejecutarSql($sql);
    //crear la tabla 
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Dia</th>';
    $tabla .= '         <th scope="col">Hora Inicio</th>';
    $tabla .= '         <th scope="col">Hora Fin</th>';
    $tabla .= '         <th scope="col">Materia</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar la tabla
    while ($fila = mysqli_fetch_assoc($rs)) {

        $tabla .= '         <tr>';
        $tabla .= '         <td>' . $fila['dia'] . '</td>';
        $tabla .= '         <td>' . $fila['hora_inicio'] . '</td>';
        $tabla .= '         <td>' . $fila['hora_fin'] . '</td>';
        $tabla .= '         <td>' . $fila['nombre'] . '</td>';
        $tabla .= '       </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' <table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

//funcion para obtener estudiantes
function fn_ejecuta_get_estudiantes() {
    //obtener datos
    header("HTTP/1.1 200 successful");
    $tipo_usuario = $_GET['tipo_usuario'];
    $id_usuario;
    $tabla;
    //determinar el tipo de usuario
    if ($tipo_usuario == "padres") {
        $id_usuario = $_SESSION['id_padre'];
        $tabla = "Padre";
    } else {
        $id_usuario = $_SESSION['id_nivel'];
        $tabla = "Alumno";
    }
    //conectar a la db
    $db = new connection();
    $db->conectar();
    $sql = "";
    //ejecutar segun el tipo de usuario
    if ($tabla == "Alumno") {
        $sql = "SELECT nombre, apellidos
            FROM Alumno 
            WHERE id_nivel = $id_usuario AND estado = 'aprobado'";
    } else if ($tabla == "Padre") {
        //consulta para obtener el nivel del hijo
        $sql1 = "SELECT A.id_nivel
        FROM Alumno A
        INNER JOIN relacion_padres_alumno RPA ON A.id_alumno = RPA.id_alumno
        WHERE RPA.id_padre = $id_usuario";

        $rs = $db->ejecutarSql($sql1);
        $id_nivel = mysqli_fetch_assoc($rs)['id_nivel'];

        //consulta en el caso  de ser padre
        $sql = "SELECT AL.nombre, AL.apellidos
            FROM Alumno AL
            INNER JOIN relacion_padres_alumno RPA ON AL.id_alumno = RPA.id_alumno
            WHERE AL.id_nivel = $id_nivel AND AL.estado = 'aprobado'";
    }

    $rs = $db->ejecutarSql($sql);
    //creacion de la tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Apellidos</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar la tabla
    while ($fila = mysqli_fetch_assoc($rs)) {
        $tabla .= '         <tr>';
        $tabla .= '         <td>' . $fila['nombre'] . '</td>';
        $tabla .= '         <td>' . $fila['apellidos'] . '</td>';
        $tabla .= '       </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' </table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

//funcion para obtener profesores
function fn_ejecuta_get_profesores() {
    //obtener datos
    header("HTTP/1.1 200 successful");
    $tipo_usuario = $_GET['tipo_usuario'];
    $id_usuario;
    $tabla;
    //establecer conexion
    $db = new connection();
    $db->conectar();
    //determinar el tipo de usuario
    if ($tipo_usuario == "padres") {
        $id_usuario = $_SESSION['id_padre'];
        $tabla = "Padre";
    } else {
        $id_usuario = $_SESSION['id_nivel'];
        $tabla = "Alumno";
    }
    //ejecutar el sql segun el usuario
    if ($tabla == "Alumno") {
        $sql = "SELECT P.nombre_profe, P.apellido, A.nombre AS asignatura
                FROM Profesor P
                INNER JOIN Horario H ON P.id_asignatura = H.id_asignatura
                INNER JOIN Asignatura A ON P.id_asignatura = A.id_asignatura
                WHERE H.id_nivel = $id_usuario";
    } else if ($tabla == "Padre") {
        $sql = "SELECT P.nombre_profe, P.apellido, A.nombre AS asignatura
        FROM Profesor P
        INNER JOIN Horario H ON P.id_asignatura = H.id_asignatura
        INNER JOIN Asignatura A ON P.id_asignatura = A.id_asignatura
        INNER JOIN Alumno AL ON H.id_nivel = AL.id_nivel
        INNER JOIN relacion_padres_alumno RPA ON RPA.id_alumno = AL.id_alumno
        WHERE RPA.id_padre = $id_usuario";
    }

    $rs = $db->ejecutarSql($sql);
    //crear la tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Apellido</th>';
    $tabla .= '         <th scope="col">Asignatura</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar la tabla
    while ($fila = mysqli_fetch_assoc($rs)) {
        $tabla .= '         <tr>';
        $tabla .= '         <td>' . $fila['nombre_profe'] . '</td>';
        $tabla .= '         <td>' . $fila['apellido'] . '</td>';
        $tabla .= '         <td>' . $fila['asignatura'] . '</td>';
        $tabla .= '       </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' </table>';

    echo $tabla;
    $db->desconectar();
    exit;
}

?>