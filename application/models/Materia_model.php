<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materia_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function obtener_materias() {

        return $this->db
                    ->where('estatus_mat', 'alta')
                    ->get('materias')
                    ->result();
    }

    public function guardar($datos) {

        return $this->db
                    ->insert('materias', $datos);
    }

    public function obtener_materia($id) {

        return $this->db
                    ->where('id_mat', $id)
                    ->get('materias')
                    ->row();
    }

    public function actualizar($id, $datos) {

        return $this->db
                    ->where('id_mat', $id)
                    ->update('materias', $datos);
    }

    public function eliminar($id) {

        $datos = array(
            'estatus_mat' => 'baja'
        );

        return $this->db
                    ->where('id_mat', $id)
                    ->update('materias', $datos);
    }
}