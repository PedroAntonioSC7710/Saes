<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }


    // OBTENER TODOS LOS PROFESORES
    public function obtener_profesores() {

        return $this->db
                    ->get('profesores')
                    ->result();
    }


    // GUARDAR PROFESOR
    public function guardar($datos) {

        return $this->db
                    ->insert('profesores', $datos);
    }


    // OBTENER UN PROFESOR
    public function obtener_profesor($id) {

        return $this->db
                    ->where('id_prof', $id)
                    ->get('profesores')
                    ->row();
    }


    // ACTUALIZAR PROFESOR
    public function actualizar($id, $datos) {

        return $this->db
                    ->where('id_prof', $id)
                    ->update('profesores', $datos);
    }


    // ELIMINAR PROFESOR
    public function eliminar($id) {

        return $this->db
                    ->where('id_prof', $id)
                    ->delete('profesores');
    }
}