<?php

class connection {
    //definir atributos
    private $server;
    private $usu;
    private $pass;
    private $db;
    private $link;
    //constructor
    public function __construct() {
        $this->server = "localhost";
        $this->usu = "root";
        $this->pass = "";
        $this->db = "proyectoescuela";
        $this->link = null;
    }
    //funcion para conectar
    function conectar() {
        try {
            $this->link = new mysqli($this->server, $this->usu, $this->pass, $this->db);
        } catch (Exception $exc) {
            echo 'Error conectando a DB' . $exc->getMessage();
            exit;
        }
    }
    //funcion desconectar
    function desconectar() {
        mysqli_close($this->link);
    }
    //ejecutar comando sql
    function ejecutarSql($sql) {
        $rs = $this->link->query($sql);
        return $rs;
    }
    //ejecutar commit
    function ejecutarCommit() {
        mysqli_commit($this->link);
    }

}


