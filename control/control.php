<?php

//iniciar session e importar librerias
session_start();
require_once 'libs/smarty/config.php';
require_once 'model/model.php';

class control {

    //atributos smarty
    private $model;
    private $view;

    //funciones de smarty
    function __construct() {
        $this->model = new model();
        $this->view = new config();
    }

    //funciones de smarty
    public function getModel() {
        return $this->model;
    }

    //funciones de smarty
    public function getView() {
        return $this->view;
    }

    //funciones de smarty
    public function setModel($model): void {
        $this->model = $model;
    }

    //funciones de smarty
    public function setView($view): void {
        $this->view = $view;
    }

    //funciones validar login alumno
    public function validarSessionAlumno() {
        try {
            //si existe el id alumno se loguea
            if (!isset($_SESSION['id_alumno'])) {
                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            header("Location: index.php");
            exit;
        }
    }

    //funciones validar login padre
    public function validarSessionPadre() {
        try {
            //si existe el id padre se loguea
            if (!isset($_SESSION['id_padre'])) {
                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            header("Location: index.php");
            exit;
        }
    }

    //funciones validar login profe
    public function validarSessionProfesor() {
        try {
            //si existe el id profe se loguea
            if (!isset($_SESSION['id_profesor'])) {
                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            header("Location: index.php");
            exit;
        }
    }

    //funciones validar login admin
    public function validarSessionAdmin() {
        try {
            //si existe el id admin se loguea
            if (!isset($_SESSION['id_administrador'])) {
                header("Location: index.php");
                exit;
            }
        } catch (Exception $e) {
            header("Location: index.php");
            exit;
        }
    }

    //funcion gestion procesos
    public function gestion_procesos() {
        //determinar el valor de accion
        if (isset($_REQUEST['accion'])) {
            $accion = $_REQUEST['accion'];
            //switch para la accion y determiar que hayq ue hacer
            switch ($accion) {
                case 'validar_login':
                    //validar login 
                    $this->validarInactividad();
                    $this->fn_Validar_Login();
                    break;
                //caso registrar alumno
                case 'validar_registroAlumno':
                    $this->validarInactividad();
                    $this->fn_RegistrarAlumno();
                    break;
                //caso registrar padre
                case 'validar_registroPadre':
                    $this->validarInactividad();
                    $this->fn_RegistrarPadres();
                    break;
                //abrir el tpl de alumno
                case 'abrirAlumno':
                    $this->validarSessionAlumno();
                    $this->validarInactividad();
                    $this->abrirAlumno();
                    break;
                //abrir el tpl de padre
                case 'abrirPadres':
                    $this->validarSessionPadre();
                    $this->validarInactividad();
                    $this->abrirPadres();
                    break;
                //tpl de profe
                case 'abrirProfesor':
                    $this->validarSessionProfesor();
                    $this->validarInactividad();
                    $this->abrirProfesor();
                    break;
                //tpl admin
                case 'abrirAdmin':
                    $this->validarSessionAdmin();
                    $this->validarInactividad();
                    $this->abrirAdmin();
                    break;
                //cerrar sesion
                case "salir":
                    $this->fn_Salir();
                    break;
            }
            //si no es ninguna
        } else {
            $this->view->Assign("msg", "");
            $this->view->Assign("msg2", "");
            $this->view->Assign("msg3", "");
            $this->view->Display("Landing.tpl");
        }
    }

    //funcion cerrar sesion
    public function fn_Salir() {
        session_destroy();
        header("Location: index.php");
    }

    //validar log in
    public function fn_Validar_Login() {
        //obtener valores para loguear
        $login = $_REQUEST['txt_usuario'];
        $pass = $_REQUEST['pwd_clave'];
        //determinar el tipo de usuario que quiere iniciar sesion
        if (isset($_REQUEST['s_tipo'])) {
            $accion2 = $_REQUEST['s_tipo'];
            //switch segun cada caso
            switch ($accion2) {
                case 'alumno':
                    //llamar a la funcion validar login estudiante
                    $respuesta = $this->model->m_ValidarLoginEstudiante($login, $pass);
                    //si devuelve algo se loguea y obtiene los datos en sesion
                    if (sizeof($respuesta) > 0) {
                        $_SESSION['id_alumno'] = $respuesta[0];
                        $_SESSION['nombre'] = $respuesta[3];
                        $_SESSION['apellidos'] = $respuesta[4];
                        $_SESSION['cedula_alumno'] = $respuesta[5];
                        $_SESSION['id_nivel'] = $respuesta[7];
                        //abrir el tpl
                        header("Location: index.php?accion=abrirAlumno");
                    } else {
                        $this->view->Assign("msg3", "");
                        $this->view->Assign("msg2", "");
                        $this->view->Assign("msg", "Error! Usuario o pass invalidado");
                        $this->view->Display("Landing.tpl");
                    }
                    break;

                case 'padre':
                    //llamar a la funcion login padre
                    $respuesta = $this->model->m_ValidarLoginPadre($login, $pass);
                    //si devuelve algo se loguea y obtiene los datos en sesion
                    if (sizeof($respuesta) > 0) {
                        $_SESSION['id_padre'] = $respuesta[0];
                        $_SESSION['nombre'] = $respuesta[1];
                        $_SESSION['apellidos'] = $respuesta[2];
                        $_SESSION['correo_padres'] = $respuesta[4];
                        //abrir el tpl
                        header("Location: index.php?accion=abrirPadres");
                    } else {
                        $this->view->Assign("msg3", "");
                        $this->view->Assign("msg2", "");
                        $this->view->Assign("msg", "Error! Usuario o pass invalidado");
                        $this->view->Display("Landing.tpl");
                    }
                    break;

                case 'profesor':
                    //llamar al login profe
                    $respuesta = $this->model->m_ValidarLoginProfesores($login, $pass);
                    //si devuelve algo se loguea y obtiene los datos en sesion
                    if (sizeof($respuesta) > 0) {
                        $_SESSION['id_profesor'] = $respuesta[0];
                        $_SESSION['nombre_profe'] = $respuesta[3];
                        $_SESSION['apellido'] = $respuesta[4];
                        $_SESSION['email'] = $respuesta[5];
                        $_SESSION['id_asignatura'] = $respuesta[8];
                        //cargar el tpl de profe
                        header("Location: index.php?accion=abrirProfesor");
                    } else {
                        $this->view->Assign("msg3", "");
                        $this->view->Assign("msg2", "");
                        $this->view->Assign("msg", "Error! Usuario o pass invalidado");
                        $this->view->Display("Landing.tpl");
                    }
                    break;

                case 'administrador':
                    //llamar al login admin
                    $respuesta = $this->model->m_ValidarLoginAdmin($login, $pass);
                    if (sizeof($respuesta) > 0) {
                        //si devuelve algo se loguea y obtiene los datos en sesion
                        $_SESSION['id_administrador'] = $respuesta[0];
                        $_SESSION['email'] = $respuesta[3];
                        //cargar el tpl de admin
                        header("Location: index.php?accion=abrirAdmin");
                    } else {
                        $this->view->Assign("msg3", "");
                        $this->view->Assign("msg2", "");
                        $this->view->Assign("msg", "Error! Usuario o pass invalidado");
                        $this->view->Display("Landing.tpl");
                    }
                    break;
                //caso default
                default:
                    $this->view->Assign("msg3", "");
                    $this->view->Assign("msg2", "");
                    $this->view->Assign("msg", "");
                    $template = "Landing.tpl";
            }
        }
    }

    //abrir tpl alumno
    public function abrirAlumno() {
        $this->view->Display("alumno.tpl");
    }

    //abrir tpl padre
    public function abrirPadres() {
        $this->view->Display("padres.tpl");
    }

    //abrir tpl admin
    public function abrirAdmin() {
        $this->view->Display("admin.tpl");
    }

    //abrir tpl profe
    public function abrirProfesor() {
        $this->view->Display("profesor.tpl");
    }

    //funcion registrar alumno
    public function fn_RegistrarAlumno() {
        //pedir al usuario sus datos
        $login = $_REQUEST['user_alumno'];
        $contrasena = $_REQUEST['pwd_clave_alumno'];
        $nombre = $_REQUEST['nombre_alumno'];
        $apellidos = $_REQUEST['apellidos_alumno'];
        $cedula = $_REQUEST['cedula_alumno'];

        //registrarlos
        $registroExitoso = $this->model->m_RegistrarAlumno($login, $contrasena, $nombre, $apellidos, $cedula);
        //ver si funciono 
        if ($registroExitoso) {
            $this->view->Assign("msg", "");
            $this->view->Assign("msg2", "registro exitoso, espere su aprovacion");
            $this->view->Assign("msg3", "");
            $this->view->Display("Landing.tpl");
        } else {
            $this->view->Assign("msg", "");
            $this->view->Assign("msg2", "Error en el registro");
            $this->view->Assign("msg3", "");
            $this->view->Display("Landing.tpl");
        }
    }

    public function fn_RegistrarPadres() {
        //pedir al usuario sus datos
        $nombre = $_REQUEST['nombre_padre'];
        $apellidos = $_REQUEST['apellido_padre'];
        $cedula = $_REQUEST['cedula_padre'];
        $correo = $_REQUEST['correo_padre'];
        $login = $_REQUEST['user_padre'];
        $contrasena = $_REQUEST['pwd_clave_padre'];

        //registrarlos
        $registroExitoso = $this->model->m_RegistrarPadre($nombre, $apellidos, $cedula, $correo, $login, $contrasena);
        //ver si funciono 
        if ($registroExitoso) {
            $this->view->Assign("msg", "");
            $this->view->Assign("msg2", "");
            $this->view->Assign("msg3", "registro exitoso, espere su aprovacion");
            $this->view->Display("Landing.tpl");
        } else {
            $this->view->Assign("msg", "");
            $this->view->Assign("msg2", "");
            $this->view->Assign("msg3", "error en el registro");
            $this->view->Display("Landing.tpl");
        }
    }

    //validar el tiempo de inactividad
    public function validarInactividad() {
        //verificamos si existe el tiempo
        if (isset($_SESSION['tiempo'])) {
            $limite = 1600; // segundos
            //realizamos la resta de tiempo dentro del portal web
            $tiempo_vida = time() - $_SESSION['tiempo'];
            //verificamos si se exedio el tiempo
            if ($tiempo_vida > $limite) {
                $this->fn_Salir();
            } else {
                $_SESSION['tiempo'] = time();
            }
        } else {
            $_SESSION['tiempo'] = time();
        }
    }

}
?> 

