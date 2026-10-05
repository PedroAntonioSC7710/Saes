<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grupo_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->load->database();
    }


    // OBTENER TODOS LOS GRUPOS
    public function obtener_grupos() {

        return $this->db
                    ->get('grupos')
                    ->result();
    }


    // GUARDAR GRUPO
    public function guardar($datos) {

        return $this->db
                    ->insert('grupos', $datos);
    }


    // OBTENER UN GRUPO
    public function obtener_grupo($id) {

        return $this->db
                    ->where('id_grup', $id)
                    ->get('grupos')
                    ->row();
    }


    // ACTUALIZAR GRUPO
    public function actualizar($id, $datos) {

        return $this->db
                    ->where('id_grup', $id)
                    ->update('grupos', $datos);
    }


    // ELIMINAR GRUPO
    public function eliminar($id) {

        return $this->db
                    ->where('id_grup', $id)
                    ->delete('grupos');
    }
}