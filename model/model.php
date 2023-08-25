<?php

require_once 'conn/conn.php';

class model {
    //creacion de conexion a la db
    private $db;

    public function __construct() {
        $this->db = new connection();
    }   
    //funcion que valida el log in de estudiantes
    public function m_ValidarLoginEstudiante($login, $pass) {
        //conectar a la db
        $this->db->conectar();
        //ejecutar sql
        $sql = "SELECT `id_alumno`, `login`, `contraseña`, `nombre`, `apellidos`, `id_colegio`, `id_nivel`, `cedula_alumno`, `estado`  
        FROM `alumno` 
        WHERE `login` = '$login' AND contraseña=md5('uh2023_$pass')  AND `estado` = 'aprobado'";

        $rs = $this->db->ejecutarSql($sql);

        $arrDatos = array();
        //guardar los resultados
        while ($fila = mysqli_fetch_assoc($rs)) {
            $arrDatos[] = $fila['id_alumno'];
            $arrDatos[] = $fila['login'];
            $arrDatos[] = $fila['contraseña'];
            $arrDatos[] = $fila['nombre'];
            $arrDatos[] = $fila['apellidos'];
            $arrDatos[] = $fila['cedula_alumno'];
            $arrDatos[] = $fila['id_colegio'];
            $arrDatos[] = $fila['id_nivel'];
            $arrDatos[] = $fila['estado'];
        }
        //desconectar
        $this->db->desconectar();

        return $arrDatos;
    }
    //funcion que valida el log in de padre
    public function m_ValidarLoginPadre($login, $pass) {
        $this->db->conectar();
        //sql a ejecutar
        $sql = "SELECT `id_padre`, `nombre`, `apellidos`, `cedula_padre`, `correo_padres`, `login`, `contraseña`,`estado`
            FROM `padres` 
            WHERE `login` = '$login' AND contraseña=md5('uh2023_$pass') AND `estado` = 'aprobado'";

        $rs = $this->db->ejecutarSql($sql);

        $arrDatos = array();
        //guardar la info recibida
        while ($fila = mysqli_fetch_assoc($rs)) {
            $arrDatos[] = $fila['id_padre'];
            $arrDatos[] = $fila['nombre'];
            $arrDatos[] = $fila['apellidos'];
            $arrDatos[] = $fila['cedula_padre'];
            $arrDatos[] = $fila['correo_padres'];
            $arrDatos[] = $fila['login'];
            $arrDatos[] = $fila['contraseña'];
        }
        //deconectar
        $this->db->desconectar();

        return $arrDatos;
    }
    //login para profesores
    public function m_ValidarLoginProfesores($login, $pass) {
        $this->db->conectar();
        //sql a ejecutar
        $sql = "SELECT `id_profesor`, `login`, `contraseña`, `nombre_profe`, `apellido`, `email`, `especialista`, `id_colegio`, `id_asignatura` 
            FROM `profesor`
            WHERE `login` = '$login' AND contraseña=md5('uh2023_$pass')";

        $rs = $this->db->ejecutarSql($sql);

        $arrDatos = array();
        //llenar con lo recibido
        while ($fila = mysqli_fetch_assoc($rs)) {
            $arrDatos[] = $fila['id_profesor'];
            $arrDatos[] = $fila['login'];
            $arrDatos[] = $fila['contraseña'];
            $arrDatos[] = $fila['nombre_profe'];
            $arrDatos[] = $fila['apellido'];
            $arrDatos[] = $fila['email'];
            $arrDatos[] = $fila['especialista'];
            $arrDatos[] = $fila['id_colegio'];
            $arrDatos[] = $fila['id_asignatura'];
        }
        //desconectar
        $this->db->desconectar();

        return $arrDatos;
    }

    public function m_ValidarLoginAdmin($login, $pass) {
        $this->db->conectar();

        $sql = "SELECT `id_administrador`, `login`, `contraseña`, `email`, `id_colegio` "
                . "FROM `administrador` "
                . "WHERE `login` = '$login' AND contraseña=md5('uh2023_$pass')";

        $rs = $this->db->ejecutarSql($sql);

        $arrDatos = array();

        while ($fila = mysqli_fetch_assoc($rs)) {
            $arrDatos[] = $fila['id_administrador'];
            $arrDatos[] = $fila['login'];
            $arrDatos[] = $fila['contraseña'];
            $arrDatos[] = $fila['email'];
            $arrDatos[] = $fila['id_colegio'];
        }
        //desconectar
        $this->db->desconectar();

        return $arrDatos;
    }
    //funcion para registrar alumnos
    public function m_RegistrarAlumno($login, $contrasena, $nombre, $apellidos, $cedula) {
        $this->db->conectar();
        
        $encriptar = md5("uh2023_$contrasena");
        //sql a ejecutar
        $sql = "INSERT INTO alumno (login, contraseña, nombre, apellidos, cedula_alumno, estado) 
            VALUES ('$login', '$encriptar', '$nombre', '$apellidos', '$cedula', 'pendiente')";

        // Ejecutar la consulta
        $rs = $this->db->ejecutarSql($sql);
        //desconectar
        $this->db->desconectar();

        return $rs;
    }
    //funcion para registrar padres
    public function m_RegistrarPadre($nombre, $apellidos, $cedula, $correo, $login, $contrasena) {
        //conectar
        $encriptar = md5("uh2023_$contrasena");
        $this->db->conectar();
        //sql a ejecutar
        $sql = "INSERT INTO padres (nombre, apellidos, cedula_padre, correo_padres, login, contraseña, estado) 
            VALUES ('$nombre', '$apellidos', '$cedula', '$correo', '$login', '$encriptar', 'pendiente')";

        // Ejecutar la consulta
        $rs = $this->db->ejecutarSql($sql);
        //desconectar
        $this->db->desconectar();

        return $rs;
    }

}
