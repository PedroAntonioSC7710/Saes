<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function obtener_alumnos() {

        return $this->db
                    ->where('estatus_al', 'alta')
                    ->get('alumnos')
                    ->result();
    }

    public function guardar_alumno($datos) {

        return $this->db
                    ->insert('alumnos', $datos);
    }

    public function obtener_alumno($id) {

        return $this->db
                    ->where('id_alumn', $id)
                    ->get('alumnos')
                    ->row();
    }


    public function actualizar_alumno($id, $datos) {

        return $this->db
                    ->where('id_alumn', $id)
                    ->update('alumnos', $datos);
    }

    public function eliminar_alumno($id) {

        $datos = array(
            'estatus_al' => 'baja'
        );

        return $this->db
                    ->where('id_alumn', $id)
                    ->update('alumnos', $datos);
    }
}