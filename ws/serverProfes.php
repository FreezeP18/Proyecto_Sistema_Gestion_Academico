<?php

session_start();
require_once '../conn/conn.php';
$tipo = $_SERVER['REQUEST_METHOD'];
//switch para saber el tipo de conexion y accion
switch ($tipo) {

    case 'GET':
        if ($_GET['action'] == 'profesores') {
            fn_ejecuta_get_profesores();
        } else if ($_GET['action'] == 'alumnos') {
            fn_ejecuta_get_alumnos();
        } else if ($_GET['action'] == 'faltas') {
            fn_ejecuta_get_faltas();
        } else if ($_GET['action'] == 'get_notas') {
            fn_obtiene_notas();
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data['action'] == 'add_falta') {
            fn_registra_falta($data);
        } else if ($data['action'] == 'add_nota') {
            fn_agrega_nota($data);
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    case 'PUT':
        parse_str(file_get_contents('php://input'), $_PUT);
        $data = json_decode($_PUT['data'], true);
        if ($data['action'] == 'edit_falta') {
            fn_edita_falta($data);
        } else if ($data['action'] == 'edit_nota') {
            fn_edita_nota($data);
        } else {
            header("HTTP/1.1 400 bad request");
            exit;
        }
        break;
    default:
        header("HTTP/1.1 405 method not allowed");
        header("allow: GET, POST,PUT");
        break;
}

//funcion para agregar notas
function fn_agrega_nota($data) {

    //obtener datos
    header("HTTP/1.1 200 successful");
    $nota = $data['nota'];
    $trimestre = $data['trimestre'];
    $id_alumno = $data['id_alumno'];
    $id_asignatura = $_SESSION['id_asignatura'];

    //abrir conexion
    $db = new connection();
    $db->conectar();

    //comando sql
    $sql = "INSERT INTO Nota (trimestre, valor, id_alumno, id_asignatura) VALUES ($trimestre, $nota, $id_alumno, $id_asignatura)";

    $response = [];
    //se verifica que haya sido exitoso
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Nota agregada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al agregar la nota.'];
    }
    //Desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

//funcion para editar notas
function fn_edita_nota($data) {
    //recibimos parametros
    header("HTTP/1.1 200 successful");
    $id_nota = $data['id_nota'];
    $nota = $data['nota'];
    $trimestre = $data['trimestre'];
    //abre la conexion
    $db = new connection();
    $db->conectar();
    //comando sql
    $sql = "UPDATE Nota SET valor = $nota, trimestre = $trimestre WHERE id_nota = $id_nota";

    $response = [];
    // se verifica que funcione
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Nota editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la nota.'];
    }
    //deesconecta
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

//megafuncion obtener notas
function fn_obtiene_notas() {
    //obtenemos parametros
    header("HTTP/1.1 200 successful");
    $id_profesor = $_SESSION['id_profesor'];
    //abrir conexion
    $db = new connection();
    $db->conectar();

    //consulta sql
    $sql_asignatura = "SELECT A.id_asignatura, A.nombre
                       FROM Asignatura A
                       INNER JOIN Profesor P ON A.id_asignatura = P.id_asignatura
                       WHERE P.id_profesor = $id_profesor";
    //asignacion de datos
    $result_asignatura = $db->ejecutarSql($sql_asignatura);
    $asignatura = mysqli_fetch_assoc($result_asignatura);
    $id_asignatura = $asignatura['id_asignatura'];

    // Consulta para obtener los alumnos de la asignatura
    $sql_alumnos = "SELECT A.id_alumno, A.nombre, A.apellidos
                    FROM Alumno A
                    INNER JOIN Matricula M ON A.id_alumno = M.id_alumno
                    WHERE M.id_asignatura = $id_asignatura";

    $result_alumnos = $db->ejecutarSql($sql_alumnos);
    //creacion de la tabla
    while ($alumno = mysqli_fetch_assoc($result_alumnos)) {
        $tabla = '<table class="table table-striped table-sm">';
        $tabla .= '     <thead>';
        $tabla .= '       <tr>';
        $tabla .= '          <th scope="col">Asignatura: ' . $asignatura['nombre'] . '</th>';
        $tabla .= '         <th scope="col">Apellidos</th>';
        $tabla .= '         <th scope="col">Trimestre</th>';
        $tabla .= '         <th scope="col">Nota</th>';
        $tabla .= '         <th scope="col">Editar</th>';

        $tabla .= '       </tr>';
        $tabla .= '     </thead>';
        $tabla .= '     <tbody>';

        // Segunda consulta para obtener las notas de este alumno en la asignatura
        $sql_notas = "SELECT N.id_nota, N.trimestre, N.valor AS nota
              FROM Nota N
              WHERE N.id_alumno = " . $alumno['id_alumno'] . " AND N.id_asignatura = $id_asignatura";
        //creacion de la tabla parte 2
        $result_notas = $db->ejecutarSql($sql_notas);
        //boton para agregar notas
        $tabla .= '  <td colspan="5"><button onclick="loadAddNotaData(' . $alumno['id_alumno'] . ')" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarNota">Agregar Nota</button></td>';

        while ($nota = mysqli_fetch_assoc($result_notas)) {
            $tabla .= '<tr>';
            $tabla .= '  <td>' . $alumno['nombre'] . '</td>';
            $tabla .= '  <td>' . $alumno['apellidos'] . '</td>';
            $tabla .= '  <td>' . $nota['trimestre'] . '</td>';

            $tabla .= '  <td>' . $nota['nota'] . '</td>';
            $tabla .= '         <td><button onclick="loadEditNotaData(' . $nota['id_nota'] . ', ' . $nota['nota'] . ', ' . $nota['trimestre'] . ')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarNota">Editar</button></td>';

            $tabla .= '</tr>';
        }
        $tabla .= '     </tbody>';
        $tabla .= '</table>';

        echo $tabla;
    }
    $db->desconectar();
    exit;
}

//funcion editar tabla
function fn_edita_falta($data) {
    //obtenemos los datos
    $id_falta = $data['id_falta'];
    $fecha = $data['fecha'];
    $justificada = $data['justificada'];
    //conectamos
    $db = new connection();
    $db->conectar();
    //comando sql
    $sql = "UPDATE Falta_Asistencia SET fecha = '$fecha', justificada = $justificada WHERE id_falta = $id_falta";

    $response = [];
    //verificar si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Falta de asistencia editada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al editar la falta de asistencia.'];
    }
    //desconectamos
    $db->desconectar();
    //redirigimos, con la info
    header('Content-Type: application/json');
    echo json_encode($response);

    exit;
}

//funcion registrar falta
function fn_registra_falta($data) {
    //recibimos datos
    $id_alumno = $data['id_alumno'];
    $id_asignatura = $_SESSION['id_asignatura'];
    $fecha = $data['fecha'];
    $justificada = $data['justificada'];
    //conectamos
    $db = new connection();
    $db->conectar();
    //comando sql
    $sql = "INSERT INTO Falta_Asistencia (fecha, justificada, id_alumno, id_asignatura) 
            VALUES ('$fecha', $justificada, $id_alumno, $id_asignatura)";

    $response = [];
    //ver si funciona
    if ($db->ejecutarSql($sql)) {
        $response = ['status' => 'success', 'message' => 'Falta de asistencia registrada correctamente.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Ocurrió un error al registrar la falta de asistencia.'];
    }
    //desconectar
    $db->desconectar();
    //Devolver info
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

//megafuncion get faltas
function fn_ejecuta_get_faltas() {
    //datos obtenidos
    header("HTTP/1.1 200 successful");
    $id_profesor = $_SESSION['id_profesor'];
    //abrir conexion
    $db = new connection();
    $db->conectar();
    //comando sql para obtener las asignaturas y el nombre
    $sql = "SELECT A.id_asignatura, A.nombre 
            FROM Asignatura A
            INNER JOIN Profesor P ON A.id_asignatura = P.id_asignatura
            WHERE P.id_profesor = $id_profesor";

    $rs = $db->ejecutarSql($sql);
    //crear tabla
    while ($asignatura = mysqli_fetch_assoc($rs)) {
        $tabla = '<table class="table table-striped table-sm">';
        $tabla .= '     <thead>';
        $tabla .= '       <tr>';
        $tabla .= '         <th scope="col">Asignatura: ' . $asignatura['nombre'] . '</th>';
        $tabla .= '         <th scope="col">Nombre</th>';
        $tabla .= '         <th scope="col">Apellidos</th>';
        $tabla .= '         <th scope="col">Faltas de asistencia</th>';
        $tabla .= '         <th scope="col">Agregar falta</th>';
        $tabla .= '       </tr>';
        $tabla .= '     </thead>';
        $tabla .= '     <tbody>';

        for ($nivel = 1; $nivel <= 5; $nivel++) {
            //segunda consulta en la tabla faltas
            $sql_alumnos = "
            SELECT AL.nombre, AL.apellidos, COUNT(F.id_falta) as faltas, AL.id_alumno
            FROM Alumno AL
            INNER JOIN Matricula M ON AL.id_alumno = M.id_alumno
            LEFT JOIN Falta_Asistencia F ON AL.id_alumno = F.id_alumno AND F.id_asignatura = " . $asignatura['id_asignatura'] . "
            WHERE M.id_asignatura = " . $asignatura['id_asignatura'] . "
            AND AL.id_nivel = $nivel
            GROUP BY AL.id_alumno";
            //ejecutar 2 consulta
            $rs_alumnos = $db->ejecutarSql($sql_alumnos);
            //crear tabla parte 2
            while ($alumno = mysqli_fetch_assoc($rs_alumnos)) {
                $tabla .= '<tr>';
                $tabla .= '  <td>' . $asignatura['nombre'] . '</td>';
                $tabla .= '  <td>' . $alumno['nombre'] . '</td>';
                $tabla .= '  <td>' . $alumno['apellidos'] . '</td>';
                $tabla .= '  <td>' . $alumno['faltas'] . '</td>';
                $tabla .= '  <td><button onclick="loadFaltaData(' . $alumno['id_alumno'] . ')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalFalta">Añadir Falta</button></td>';
                $tabla .= '</tr>';
                // Crea una tabla para las faltas
                $tabla .= '         <tr><td colspan="4">';
                $tabla .= '         <table class="table table-striped table-sm">';
                $tabla .= '         <tr><th scope="col">Justificada</th><th scope="col">Fecha</th><th scope="col">Acción</th></tr>';

                // Obtén los detalles de las faltas ipor cada alumno
                $sql_faltas = "
                SELECT F.id_falta, F.fecha, F.justificada
                FROM Falta_Asistencia F
                WHERE F.id_alumno = " . $alumno['id_alumno'] . " AND F.id_asignatura = " . $asignatura['id_asignatura'];

                $rs_faltas = $db->ejecutarSql($sql_faltas);
                //crear tabla parte 3
                while ($falta = mysqli_fetch_assoc($rs_faltas)) {
                    $tabla .= '         <tr>';
                    $tabla .= '         <td>' . ($falta['justificada'] ? "Sí" : "No") . '</td>';
                    $tabla .= '         <td>' . $falta['fecha'] . '</td>';
                    $tabla .= '         <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditarFalta" onclick="loadEditFaltaData(' . $falta['id_falta'] . ', \'' . $falta['fecha'] . '\', ' . $falta['justificada'] . ')">Editar</button> </td>';
                    $tabla .= '         </tr>';
                }

                $tabla .= '         </table>';
                $tabla .= '         </td></tr>';
            }
        }

        $tabla .= '     </tbody>';
        $tabla .= '</table>';

        echo $tabla;
    }
    //desconectar
    $db->desconectar();

    exit;
}

//funcion get profesores
function fn_ejecuta_get_profesores() {
    header("HTTP/1.1 200 successful");
    //conectamos
    $db = new connection();
    $db->conectar();

    // comando sql
    $sql = "SELECT * FROM Profesor";

    $rs = $db->ejecutarSql($sql);
    //tabla
    $tabla = '<table class="table table-striped table-sm">';
    $tabla .= '     <thead>';
    $tabla .= '       <tr>';
    $tabla .= '         <th scope="col">Nombre</th>';
    $tabla .= '         <th scope="col">Apellidos</th>';
    $tabla .= '         <th scope="col">Email</th>';
    $tabla .= '         <th scope="col">Especialista</th>';
    $tabla .= '       </tr>';
    $tabla .= '     </thead>';
    $tabla .= '     <tbody>';
    //llenar con la info
    while ($profesor = mysqli_fetch_assoc($rs)) {
        $tabla .= '         <tr>';
        $tabla .= '         <td>' . $profesor['nombre_profe'] . '</td>';
        $tabla .= '         <td>' . $profesor['apellido'] . '</td>';
        $tabla .= '         <td>' . $profesor['email'] . '</td>';
        $tabla .= '         <td>' . $profesor['especialista'] . '</td>';
        $tabla .= '       </tr>';
    }

    $tabla .= '    </tbody>';
    $tabla .= ' </table>';

    echo $tabla;
    //desconectar
    $db->desconectar();

    exit;
}

//funcion get alumnos
function fn_ejecuta_get_alumnos() {
    //obtener datos
    header("HTTP/1.1 200 successful");
    $id_profesor = $_SESSION['id_profesor'];
    //conectar
    $db = new connection();
    $db->conectar();

    //comando sql 1
    $sql = "SELECT A.id_asignatura, A.nombre 
            FROM Asignatura A
            INNER JOIN Profesor P ON A.id_asignatura = P.id_asignatura
            WHERE P.id_profesor = $id_profesor";

    $rs = $db->ejecutarSql($sql);
    //crear tabla
    while ($asignatura = mysqli_fetch_assoc($rs)) {
        $tabla = '<table class="table table-striped table-sm">';
        $tabla .= '     <thead>';
        $tabla .= '       <tr>';
        $tabla .= '         <th scope="col">Asignatura: ' . $asignatura['nombre'] . '</th>';
        $tabla .= '         <th scope="col">Nombre</th>';
        $tabla .= '         <th scope="col">Apellidos</th>';
        $tabla .= '       </tr>';
        $tabla .= '     </thead>';
        $tabla .= '     <tbody>';

        //obtener alumnos segun el nivel y si estan matriculados
        for ($nivel = 1; $nivel <= 5; $nivel++) {
            $sql_alumnos = "SELECT AL.id_alumno, AL.nombre, AL.apellidos  
            FROM Alumno AL
            INNER JOIN Matricula M ON AL.id_alumno = M.id_alumno
            WHERE M.id_asignatura = " . $asignatura['id_asignatura'] . "
            AND AL.id_nivel = $nivel";

            $rs_alumnos = $db->ejecutarSql($sql_alumnos);
            //contruir tabla
            while ($alumno = mysqli_fetch_assoc($rs_alumnos)) {
                $tabla .= '         <tr>';
                $tabla .= '         <td>Nivel ' . $nivel . '</td>';
                $tabla .= '         <td>' . $alumno['nombre'] . '</td>';
                $tabla .= '         <td>' . $alumno['apellidos'] . '</td>';
                $tabla .= '       </tr>';
            }
        }


        $tabla .= '    </tbody>';
        $tabla .= ' </table>';

        echo $tabla;
    }
    //desconexion
    $db->desconectar();

    exit;
}

?>