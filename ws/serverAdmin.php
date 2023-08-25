<?php

session_start();
require_once '../conn/conn.php';
$tipo = $_SERVER['REQUEST_METHOD'];
//switch para saber el tipo de conexion y accion
switch ($tipo) {

    case 'GET':
        if ($_GET['action'] == 'asignaturas') {
            fn_obtiene_materias();
        } else if ($_GET['action'] == 'alumnospen') {
            fn_obtiene_alumnospen();
        } else if ($_GET['action'] == 'padrespen') {
            fn_obtiene_padrespen();
        } else if ($_GET['action'] == 'profesores') {
            fn_obtiene_profesores();
        } else if ($_GET['action'] == 'padres') {
            fn_obtiene_padres();
        } else if ($_GET['action'] == 'alumnos') {
            fn_obtiene_alumnos();
        } else if ($_GET['action'] == 'matricula') {
            fn_obtiene_matricula();
        } else if ($_GET['action'] == 'relacion') {
            fn_obtiene_relacion_padres_alumno();
        } else if ($_GET['action'] == 'horarios') {
            fn_obtiene_horario();
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    case 'POST':
        $data = json_decode($_POST['data'], true);
        if ($data['action'] == 'agregarAsignatura') {
            fn_agregar_asignatura($data);
        } else if ($data['action'] == 'agregarProfesor') {
            fn_agregar_profesor($data);
        } else if ($data['action'] == 'agregarMatricula') {
            fn_agregar_matricula($data);
        } else if ($data['action'] == 'agregarRelacionPadreAlumno') {
            fn_agregar_relacion($data);
        } else if ($data['action'] == 'agregarHorario') {
            fn_agregar_horario($data);
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    case 'PUT':
        parse_str(file_get_contents('php://input'), $_PUT);
        $data = json_decode($_PUT['data'], true);
        if ($data['action'] == 'editarAsignatura') {
            fn_edita_asignatura($data);
        } else if ($data['action'] == 'editarAlumno') {
            fn_editar_alumno($data);
        } else if ($data['action'] == 'editarPadre') {
            fn_editar_padre($data);
        } else if ($data['action'] == 'editarProfesor') {
            fn_editar_profesor($data);
        } else if ($data['action'] == 'editarPadre2') {
            fn_editar_padre2($data);
        } else if ($data['action'] == 'editarAlumno2') {
            fn_editar_alumno2($data);
        } else if ($data['action'] == 'editarHorario') {
            fn_editar_horario($data);
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    case 'DELETE':
        parse_str(file_get_contents('php://input'), $_DELETE);
        $data = json_decode($_DELETE['data'], true);
        if ($data['action'] == 'borrarAsignatura') {
            fn_borrar_asignatura($data);
        } else if ($data['action'] == 'borrarProfe') {
            fn_borrar_profe($data);
        } else if ($data['action'] == 'borrarPadre') {
            fn_borrar_padre($data);
        } else if ($data['action'] == 'borrarAlumno') {
            fn_borrar_alumno($data);
        } else if ($data['action'] == 'borrarMatricula') {
            fn_borrar_matricula($data);
        } else if ($data['action'] == 'borrarHorario') {
            fn_borrar_horario($data);
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;

    default:
        header("HTTP/1.1 405 method not allowed");
        header("allow: GET, POST,PUT,DELETE");
        break;
}

function fn_agregar_horario($data) {
    //conexion establecida
    header("HTTP/1.1 200 successful");

    // Obtenemos los datos
    $dia = $data['dia'];
    $hora_inicio = $data['hora_inicio'];
    $hora_fin = $data['hora_fin'];
    $id_asignatura = $data['id_asignatura'];
    $id_nivel = $data['id_nivel'];

    // Conectamos
    $db = new connection();
    $db->conectar();

    // Comando SQL
    $sql = "INSERT INTO horario (dia, hora_inicio, hora_fin, id_asignatura, id_nivel) VALUES ('$dia', '$hora_inicio', '$hora_fin', '$id_asignatura', '$id_nivel')";

    $response = [];

    // Verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Horario añadido correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al añadir el horario.'];
    }

    // Desconectamos
    $db->desconectar();

    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_borrar_horario($data) {
    //conectar exitosamente
    header("HTTP/1.1 200 successful");

    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //obtener datos
    $id_horario = $data['id_horario'];
    //comando sql
    $sql = "DELETE FROM horario WHERE id_horario = $id_horario";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }
    //deconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_editar_horario($data) {
    //respuesta correcta
    header("HTTP/1.1 200 successful");

    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //obtener datos
    $id_horario = $data['id_horario'];
    $dia = $data['dia'];
    $hora_inicio = $data['hora_inicio'];
    $hora_fin = $data['hora_fin'];
    $id_asignatura = $data['id_asignatura'];
    $id_nivel = $data['id_nivel'];
    //comando sql
    $sql = "UPDATE horario SET dia = '$dia', hora_inicio = '$hora_inicio', hora_fin = '$hora_fin', id_asignatura = '$id_asignatura', id_nivel = '$id_nivel' WHERE id_horario = $id_horario";
    //ver si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Horario editado correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar el horario.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    echo json_encode($response);
    exit;
}

function fn_obtiene_horario() {
    //conectar
    header("HTTP/1.1 200 successful");
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todos los horarios con el nombre de la asignatura
    $sql_horario = "SELECT h.id_horario, h.dia, h.hora_inicio, h.hora_fin, h.id_asignatura, a.nombre AS asignatura, h.id_nivel FROM Horario h JOIN Asignatura a ON h.id_asignatura = a.id_asignatura;";
    $result_horario = $db->ejecutarSql($sql_horario);
    //crear tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '  <button onclick="abrirModalCrearHorario()" class="btn btn-success">Crear Horario</button>';
    $tabla .= '         <th scope="col">Día</th>';
    $tabla .= '         <th scope="col">Hora de Inicio</th>';
    $tabla .= '         <th scope="col">Hora de Fin</th>';
    $tabla .= '         <th scope="col">ID Asignatura</th>';
    $tabla .= '         <th scope="col">Asignatura</th>';
    $tabla .= '         <th scope="col">ID Nivel</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '         <th scope="col">Borrar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar tabla
    while ($horario = mysqli_fetch_assoc($result_horario)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $horario['dia'] . '</td>';
        $tabla .= '    <td>' . $horario['hora_inicio'] . '</td>';
        $tabla .= '    <td>' . $horario['hora_fin'] . '</td>';
        $tabla .= '    <td>' . $horario['id_asignatura'] . '</td>';
        $tabla .= '    <td>' . $horario['asignatura'] . '</td>';
        $tabla .= '    <td>' . $horario['id_nivel'] . '</td>';
        $tabla .= '    <td><button onclick="editarHorario(' . $horario['id_horario'] . ', \'' . $horario['dia'] . '\', \'' . $horario['hora_inicio'] . '\', \'' . $horario['hora_fin'] . '\', \'' . $horario['id_asignatura'] . '\', \'' . $horario['id_nivel'] . '\')" class="btn btn-primary">Editar</button></td>';
        $tabla .= '    <td><button onclick="borrarHorario(' . $horario['id_horario'] . ')" class="btn btn-danger">Borrar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
}

function fn_agregar_relacion($data) {
    //conexion correctaa
    header("HTTP/1.1 200 successful");

    // Obtenemos los datos
    $id_padre = $data['id_padre'];
    $id_alumno = $data['id_alumno'];
    // Conectamos
    $db = new connection();
    $db->conectar();

    // Comando SQL
    $sql = "INSERT INTO relacion_padres_alumno (id_padre, id_alumno) VALUES ('$id_padre', '$id_alumno')";

    $response = [];

    // Verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Matrícula añadida correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al añadir la matrícula.'];
    }

    // Desconectamos
    $db->desconectar();

    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_obtiene_relacion_padres_alumno() {
    //conexion exitosa
    header("HTTP/1.1 200 successful");
    //conectar a la db
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todas las relaciones entre padres y alumnos
    $sql_relacion = "SELECT r.id_relacion, p.id_padre, a.id_alumno, p.nombre AS nombre_padre, p.apellidos AS "
            . "apellidos_padre, a.nombre AS nombre_alumno, a.apellidos AS apellidos_alumno FROM relacion_padres_alumno r "
            . "JOIN padres p ON r.id_padre = p.id_padre JOIN alumno a ON r.id_alumno = a.id_alumno;";
    $result_relacion = $db->ejecutarSql($sql_relacion);
    //crear tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '  <button onclick="abrirModalCrearRelacion()" class="btn btn-success">Crear Relación</button>';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre Padre</th>';
    $tabla .= '         <th scope="col">Apellido Padre</th>';
    $tabla .= '         <th scope="col">Nombre Alumno</th>';
    $tabla .= '         <th scope="col">Apellido Alumno</th>';
    $tabla .= '         <th scope="col">Borrar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar tabla
    while ($relacion = mysqli_fetch_assoc($result_relacion)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $relacion['nombre_padre'] . '</td>';
        $tabla .= '    <td>' . $relacion['apellidos_padre'] . '</td>';
        $tabla .= '    <td>' . $relacion['nombre_alumno'] . '</td>';
        $tabla .= '    <td>' . $relacion['apellidos_alumno'] . '</td>';
        $tabla .= '    <td><button onclick="borrarRelacionPadreAlumno(' . $relacion['id_relacion'] . ')" class="btn btn-danger">Borrar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
}

function fn_borrar_matricula($data) {
    //conexion correcta
    header("HTTP/1.1 200 successful");
    //obtener datos
    $id_matricula = $data['id_matricula'];
    //conectar a la db
    $db = new connection();
    $db->conectar();
    //comando sql
    $sql = "DELETE FROM matricula WHERE id_matricula = $id_matricula";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_agregar_matricula($data) {
    //conexiona decuada
    header("HTTP/1.1 200 successful");

    // Obtenemos los datos
    $id_alumno = $data['id_alumno'];
    $id_asignatura = $data['id_asignatura'];

    // Conectamos
    $db = new connection();
    $db->conectar();

    // Comando SQL
    $sql = "INSERT INTO matricula (id_alumno, id_asignatura) VALUES ('$id_alumno', '$id_asignatura')";

    $response = [];

    // Verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Matrícula añadida correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al añadir la matrícula.'];
    }

    // Desconectamos
    $db->desconectar();

    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_obtiene_matricula() {
    //conexion adecuada
    header("HTTP/1.1 200 successful");
    //cpnectar a la db
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todas las matrículas incluyendo el apellido del alumno
    $sql_matricula = "SELECT m.id_matricula, a.id_alumno, asig.id_asignatura, a.nombre AS alumno, a.apellidos AS apellidos, asig.nombre AS asignatura FROM matricula m JOIN alumno a ON m.id_alumno = a.id_alumno JOIN asignatura asig ON m.id_asignatura = asig.id_asignatura;";
    $result_matricula = $db->ejecutarSql($sql_matricula);
    //crear tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '  <button onclick="abrirModalCrearMatricula()" class="btn btn-success">Crear Matricula</button>';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">ID Asignatura</th>';
    $tabla .= '         <th scope="col">Asignatura</th>';
    $tabla .= '         <th scope="col">Nombre Alumno</th>';
    $tabla .= '         <th scope="col">Apellido Alumno</th>';
    $tabla .= '         <th scope="col">Borrar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar tabla
    while ($matricula = mysqli_fetch_assoc($result_matricula)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $matricula['id_asignatura'] . '</td>';
        $tabla .= '    <td>' . $matricula['asignatura'] . '</td>';
        $tabla .= '    <td>' . $matricula['alumno'] . '</td>';
        $tabla .= '    <td>' . $matricula['apellidos'] . '</td>';
        $tabla .= '    <td><button onclick="borrarAlumnoAsignatura(' . $matricula['id_matricula'] . ')" class="btn btn-danger">Borrar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';
    //desconectar
    $db->desconectar();
    echo $tabla;
}

function fn_borrar_alumno($data) {
    //conexion adecuada
    header("HTTP/1.1 200 successful");
    //obtener datos
    $id_alumno = $data['id_alumno'];
    //conectar
    $db = new connection();
    $db->conectar();
    //comando sql
    $sql = "DELETE FROM alumno WHERE id_alumno = $id_alumno";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_editar_alumno2($data) {
    //conexion adecuada
    header("HTTP/1.1 200 successful");
    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //obtener datos
    $id_alumno = $data['id'];
    $login = $data['login'];
    $contrasena = $data['contrasena'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $nivel = $data['nivel'];
    $cedula = $data['cedula'];
    $estado = $data['estado'];
    //verificar si el campo de contraseña esta vacio
    if ($contrasena == null) {
        $sql = "UPDATE alumno SET login = '$login', nombre = '$nombre', apellidos = '$apellido', id_nivel = '$nivel', cedula_alumno = '$cedula', estado = '$estado' WHERE id_alumno = $id_alumno";
    } else {
        $contrasena2 = md5("uh2023_$contrasena");
        $sql = "UPDATE alumno SET login = '$login', contraseña = '$contrasena2', nombre = '$nombre', apellidos = '$apellido', id_nivel = '$nivel', cedula_alumno = '$cedula', estado = '$estado' WHERE id_alumno = $id_alumno";
    }

    //ejecutar sql
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Alumno editado correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar el alumno.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    echo json_encode($response);
    exit;
}

function fn_obtiene_alumnos() {
    //conexion adecuada
    header("HTTP/1.1 200 successful");
    // Abrir conexión
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todos los padre con estado aprobado
    $sql_alumno = "SELECT * FROM `alumno` WHERE estado = 'aprobado'";
    $result_alumno = $db->ejecutarSql($sql_alumno);
    //crear tabla
    $tabla = '<div class="table-actions">';
    $tabla .= '</div>';
    $tabla .= '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Id Alumno</th>';
    $tabla .= '         <th scope="col">Login</th>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Apellido</th>';
    $tabla .= '         <th scope="col">Nivel</th>';
    $tabla .= '         <th scope="col">Cedula</th>';
    $tabla .= '         <th scope="col">Estado</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '         <th scope="col">Eliminar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //llenar tabla
    while ($alumno = mysqli_fetch_assoc($result_alumno)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $alumno['id_alumno'] . '</td>';
        $tabla .= '    <td>' . $alumno['login'] . '</td>';
        $tabla .= '    <td>' . $alumno['nombre'] . '</td>';
        $tabla .= '    <td>' . $alumno['apellidos'] . '</td>';
        $tabla .= '    <td>' . $alumno['id_nivel'] . '</td>';
        $tabla .= '    <td>' . $alumno['cedula_alumno'] . '</td>';
        $tabla .= '    <td>' . $alumno['estado'] . '</td>';
        $tabla .= '    <td><button onclick="loadEditAlumnoData2(' . $alumno['id_alumno'] . ', \'' . $alumno['login'] . '\', \'' . $alumno['nombre'] . '\', \'' . $alumno['apellidos'] . '\', \'' . $alumno['id_nivel'] . '\', \'' . $alumno['cedula_alumno'] . '\', \'' . $alumno['estado'] . '\')" class="btn btn-primary">Editar</button></td>';
        $tabla .= '    <td><button onclick="eliminarAlumno(' . $alumno['id_alumno'] . ')" class="btn btn-danger">Eliminar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

function fn_borrar_padre($data) {
    //establecer conexion adecuada
    header("HTTP/1.1 200 successful");
    //datos
    $id_padre = $data['id_padre'];
    //conectar a la db
    $db = new connection();
    $db->conectar();
    //comando sql
    $sql = "DELETE FROM padres WHERE id_padre = $id_padre";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

function fn_editar_padre2($data) {
    //conexion adecuaada
    header("HTTP/1.1 200 successful");
    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //datos
    $id_padre = $data['id'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $cedula = $data['cedula'];
    $correo = $data['correo'];
    $login = $data['login'];
    $contrasena = $data['contrasena'];
    $estado = $data['estado'];
    //verificar si contraseña es null
    if ($contrasena == null) {
        $sql = "UPDATE padres SET nombre = '$nombre', apellidos = '$apellido', cedula_padre = '$cedula', correo_padres = '$correo', login = '$login', estado = '$estado' WHERE id_padre = $id_padre";
    } else {
        $contrasena2 = md5("uh2023_$contrasena");
        $sql = "UPDATE padres SET nombre = '$nombre', apellidos = '$apellido', cedula_padre = '$cedula', correo_padres = '$correo', login = '$login', contraseña = '$contrasena2', estado = '$estado' WHERE id_padre = $id_padre";
    }

    //ejecutar
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Padre editado correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar el padre.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    echo json_encode($response);
    exit;
}

function fn_obtiene_padres() {
    //conexiona decuada
    header("HTTP/1.1 200 successful");
    // Abrir conexión
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todos los padre con estado aprobado
    $sql_padre = "SELECT * FROM `padres` WHERE estado = 'aprobado'";
    $result_padre = $db->ejecutarSql($sql_padre);
    //crear tabla
    $tabla = '<div class="table-actions">';
    $tabla .= '</div>';
    $tabla .= '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Id Padre</th>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Apellido</th>';
    $tabla .= '         <th scope="col">Cedula</th>';
    $tabla .= '         <th scope="col">Correo</th>';
    $tabla .= '         <th scope="col">Login</th>';
    $tabla .= '         <th scope="col">Estado</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '         <th scope="col">Eliminar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar tabla
    while ($padre = mysqli_fetch_assoc($result_padre)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $padre['id_padre'] . '</td>';
        $tabla .= '    <td>' . $padre['nombre'] . '</td>';
        $tabla .= '    <td>' . $padre['apellidos'] . '</td>';
        $tabla .= '    <td>' . $padre['cedula_padre'] . '</td>';
        $tabla .= '    <td>' . $padre['correo_padres'] . '</td>';
        $tabla .= '    <td>' . $padre['login'] . '</td>';
        $tabla .= '    <td>' . $padre['estado'] . '</td>';
        $tabla .= '    <td><button onclick="loadEditPadreData2(' . $padre['id_padre'] . ', \'' . $padre['nombre'] . '\', \'' . $padre['apellidos'] . '\', \'' . $padre['cedula_padre'] . '\', \'' . $padre['correo_padres'] . '\', \'' . $padre['login'] . '\', \'' . $padre['estado'] . '\')" class="btn btn-primary">Editar</button></td>';

        $tabla .= '    <td><button onclick="eliminarPadre(' . $padre['id_padre'] . ')" class="btn btn-danger">Eliminar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

function fn_agregar_profesor($data) {
    //conexion adecuada
    header("HTTP/1.1 200 successful");

    // Obtenemos los datos del profesor
    $login = $data['login'];
    $contrasena = $data['contraseña'];
    $nombre_profe = $data['nombre_profe'];
    $apellido = $data['apellido'];
    $email = $data['email'];
    $especialista = $data['especialista'];
    $nombre_asignatura = $data['nombre_asignatura'];

    // Conectamos
    $db = new connection();
    $db->conectar();

    // Comando SQL para insertar la asignatura
    $sql_asignatura = "INSERT INTO Asignatura (nombre)
                       VALUES ('$nombre_asignatura')";

    if ($db->ejecutarSql($sql_asignatura)) {
        // Obtenemos el ID de la asignatura insertada
        $sql_get_id_asignatura = "SELECT id_asignatura FROM Asignatura WHERE nombre = '$nombre_asignatura'";
        $result = $db->ejecutarSql($sql_get_id_asignatura);
        $row = $result->fetch_assoc();
        $id_asignatura = $row['id_asignatura'];
        $contrasena2 = md5("uh2023_$contrasena");
        // Comando SQL para insertar el profesor
        $sql_profesor = "INSERT INTO Profesor (login, contraseña, nombre_profe, apellido, email, especialista, id_asignatura)
                         VALUES ('$login', '$contrasena2', '$nombre_profe', '$apellido', '$email', '$especialista', $id_asignatura)";

        // Verificar si funciona la inserción del profesor
        if ($db->ejecutarSql($sql_profesor)) {
            $response = ['status' => 'success', 'message' => 'Profesor y asignatura añadidos correctamente.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Ocurrió un error al añadir el profesor.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al añadir la asignatura.'];
    }

    // Desconectamos
    $db->desconectar();

    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_borrar_profe($data) {
    //conectar adecuadamente
    header("HTTP/1.1 200 successful");
    //obtener datos
    $id_profe = $data['id_profe'];
    //conectar a la db
    $db = new connection();
    $db->conectar();

    // Utilizando declaraciones preparadas para seguridad
    $sql = "DELETE FROM profesor WHERE id_profesor = $id_profe";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_editar_profesor($data) {
    //conectarse adecuadamente
    header("HTTP/1.1 200 successful");
    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //obtener datos
    $id_profesor = $data['id_profesor'];
    $login = $data['login'];
    $contrasena = $data['contraseña'];
    $nombre_profe = $data['nombre_profe'];
    $apellido = $data['apellido'];
    $email = $data['email'];
    $especialista = $data['especialista'];
    $nombre_asignatura = $data['nombre_asignatura'];
    //verificar is contraseña es null
    if ($contrasena == null) {
        $sql_profesor = "UPDATE profesor 
                    SET login = '$login', nombre_profe = '$nombre_profe', apellido = '$apellido', email = '$email', especialista = '$especialista'
                    WHERE id_profesor = $id_profesor";
    } else {
        $contrasena2 = md5("uh2023_$contrasena");
        $sql_profesor = "UPDATE profesor 
                    SET login = '$login', contraseña = '$contrasena2', nombre_profe = '$nombre_profe', apellido = '$apellido', email = '$email', especialista = '$especialista'
                    WHERE id_profesor = $id_profesor";
    }
    // Actualizar la tabla de profesores


    $id_asignatura_editado = $data['id_asignatura_edit2'];

    $sql_asignatura = "UPDATE asignatura 
                   SET nombre = '$nombre_asignatura'
                   WHERE id_asignatura = $id_asignatura_editado";

    if ($db->ejecutarSql($sql_profesor) && $db->ejecutarSql($sql_asignatura)) {
        $response = ['status' => 'success', 'message' => 'Profesor y asignatura editados correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar el profesor o la asignatura.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    echo json_encode($response);
    exit;
}

function fn_obtiene_profesores() {
    //conectar adecuadamente
    header("HTTP/1.1 200 successful");

    // Abrir conexión
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todos los profesores
    $sql_profesor = "SELECT profesor.id_profesor, profesor.login, "
            . "profesor.contraseña, profesor.nombre_profe, profesor.apellido, "
            . "profesor.email, profesor.especialista, profesor.id_asignatura, asignatura.nombre AS nombre_asignatura "
            . "FROM profesor LEFT JOIN asignatura ON profesor.id_asignatura = asignatura.id_asignatura";

    $result_profesor = $db->ejecutarSql($sql_profesor);
    //crear tabla
    $tabla = '<div class="table-actions">';
    $tabla .= '  <button onclick="abrirModalAgregarProfe()" class="btn btn-success">Añadir Profesor</button>';
    $tabla .= '</div>';
    $tabla .= '<table class="table table-striped table-sm">';

    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Login</th>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Apellido</th>';
    $tabla .= '         <th scope="col">Email</th>';
    $tabla .= '         <th scope="col">Especialista</th>';
    $tabla .= '         <th scope="col">Asignatura</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '         <th scope="col">Eliminar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar tabla
    while ($profesor = mysqli_fetch_assoc($result_profesor)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $profesor['login'] . '</td>';
        $tabla .= '    <td>' . $profesor['nombre_profe'] . '</td>';
        $tabla .= '    <td>' . $profesor['apellido'] . '</td>';
        $tabla .= '    <td>' . $profesor['email'] . '</td>';
        $tabla .= '    <td>' . $profesor['especialista'] . '</td>';
        $tabla .= '    <td>' . $profesor['nombre_asignatura'] . '</td>';
        $tabla .= '    <td><button onclick="loadEditProfeData(' . $profesor['id_profesor'] . ', \'' . $profesor['login'] . '\', \'' . $profesor['nombre_profe'] . '\', \'' . $profesor['apellido'] . '\', \'' . $profesor['email'] . '\', \'' . $profesor['especialista'] . '\', \'' . $profesor['id_asignatura'] . '\', \'' . $profesor['nombre_asignatura'] . '\')" class="btn btn-primary">Editar</button></td>';

        $tabla .= '    <td><button onclick="eliminarProfe(' . $profesor['id_profesor'] . ')" class="btn btn-danger">Eliminar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

function fn_editar_padre($data) {
    //conectar correctamente
    header("HTTP/1.1 200 successful");
    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //datos
    $id_padre = $data['id_padre'];
    $nombre = $data['nombre'];
    $estado = $data['estado'];
    //comando sql
    $sql = "UPDATE padres SET nombre = '$nombre', estado = '$estado' WHERE id_padre = $id_padre";

    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Padre editado correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar el padre.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    echo json_encode($response);
    exit;
}

function fn_obtiene_padrespen() {
    //conectar 
    header("HTTP/1.1 200 successful");
    // Abrir conexión
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todos los padre con estado pendiente
    $sql_padre = "SELECT * FROM `padres` WHERE estado = 'pendiente'";
    $result_padre = $db->ejecutarSql($sql_padre);
    //crear tabla
    $tabla = '<div class="table-actions">';

    $tabla .= '</div>';
    $tabla .= '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Estado</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rellenar tabla
    while ($padre = mysqli_fetch_assoc($result_padre)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $padre['nombre'] . '</td>';
        $tabla .= '    <td>' . $padre['estado'] . '</td>';
        $tabla .= '    <td><button onclick="loadEditPadreData(' . $padre['id_padre'] . ', \'' . $padre['nombre'] . '\', \'' . $padre['estado'] . '\')" class="btn btn-primary">Editar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}

function fn_editar_alumno($data) {
    //conectar
    header("HTTP/1.1 200 successful");
    // Conectarse a la base de datos
    $db = new connection();
    $db->conectar();
    //datos
    $id_alumno = $data['id_alumno'];
    $id_nivel = $data['id_nivel'];
    $estado = $data['estado'];
    //comando sql
    $sql = "UPDATE alumno SET id_nivel = '$id_nivel', estado = '$estado' WHERE id_alumno = $id_alumno";

    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Alumno editado correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar el alumno.'];
    }
    //Desconectar
    $db->desconectar();
    //Devolver info
    echo json_encode($response);
    exit;
}

function fn_obtiene_alumnospen() {
    //conectar
    header("HTTP/1.1 200 successful");
    // Abrir conexión
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todos los alumnos con estado pendiente
    $sql_alumno = "SELECT * FROM `alumno` WHERE estado = 'pendiente'";
    $result_alumno = $db->ejecutarSql($sql_alumno);
    //crear tabla
    $tabla = '<div class="table-actions">';

    $tabla .= '</div>';
    $tabla .= '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">ID Nivel</th>';
    $tabla .= '         <th scope="col">Estado</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //rrellenar tabla
    while ($alumno = mysqli_fetch_assoc($result_alumno)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $alumno['nombre'] . '</td>';
        $tabla .= '    <td>' . $alumno['id_nivel'] . '</td>';
        $tabla .= '    <td>' . $alumno['estado'] . '</td>';
        $tabla .= '    <td><button onclick="loadEditAlumnoData(' . $alumno['id_alumno'] . ', \'' . $alumno['nombre'] . '\', \'' . $alumno['estado'] . '\')" class="btn btn-primary">Editar</button></td>';

        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //Desconectar
    $db->desconectar();
    exit;
}

function fn_agregar_asignatura($data) {
    //conectar
    header("HTTP/1.1 200 successful");
    // Obtenemos los datos
    $nombre = $data['nombre'];

    // Conectamos
    $db = new connection();
    $db->conectar();

    // Comando SQL
    $sql = "INSERT INTO Asignatura (nombre) VALUES ('$nombre')";

    $response = [];

    // Verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura añadida correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al añadir la asignatura.'];
    }

    // Desconectamos
    $db->desconectar();

    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_borrar_asignatura($data) {
    //conectar
    header("HTTP/1.1 200 successful");
    //obtener datos
    $id_asignatura = $data['id_asignatura'];
    //conectar db
    $db = new connection();
    $db->conectar();

    // Utilizando declaraciones preparadas para seguridad
    $sql = "DELETE FROM Asignatura WHERE id_asignatura = $id_asignatura";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_edita_asignatura($data) {
    //conectar
    header("HTTP/1.1 200 successful");
    //obtenemos los datos
    $id_asignatura = $data['id_asignatura'];
    $nombre = $data['nombre'];

    //conectamos
    $db = new connection();
    $db->conectar();

    //comando sql
    $sql = "UPDATE Asignatura SET nombre = '$nombre' WHERE id_asignatura = $id_asignatura";

    $response = [];

    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Asignatura editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la asignatura.'];
    }

    //desconectamos
    $db->desconectar();

    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

function fn_obtiene_materias() {
    //obtenemos conexion
    header("HTTP/1.1 200 successful");

    //abrir conexion
    $db = new connection();
    $db->conectar();

    // Consulta para obtener todas las asignaturas
    $sql_asignatura = "SELECT A.id_asignatura, A.nombre FROM Asignatura A";
    $result_asignatura = $db->ejecutarSql($sql_asignatura);
    //crear tabla
    $tabla = '<div class="table-actions">';
    $tabla .= '  <button onclick="abrirModalAgregarAsignatura()" class="btn btn-success">Añadir Asignatura</button>';
    $tabla .= '</div>';
    $tabla .= '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Editar</th>';
    $tabla .= '         <th scope="col">Eliminar</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //llenar tabla
    while ($asignatura = mysqli_fetch_assoc($result_asignatura)) {
        $tabla .= '  <tr>';
        $tabla .= '    <td>' . $asignatura['nombre'] . '</td>';
        $tabla .= '    <td><button onclick="loadEditAsignaturaData(' . $asignatura['id_asignatura'] . ', \'' . $asignatura['nombre'] . '\')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarAsignatura">Editar</button></td>';

        $tabla .= '    <td><button onclick="eliminarAsignatura(' . $asignatura['id_asignatura'] . ')" class="btn btn-danger">Eliminar</button></td>';
        $tabla .= '  </tr>';
    }

    $tabla .= '     </tbody>';
    $tabla .= '</table>';

    echo $tabla;
    //desconectar
    $db->desconectar();
    exit;
}
?>

