<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calificacion_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function obtener_calificaciones() {
        return $this->db
            ->select('c.id_alumn, c.id_prof, c.id_mat, c.id_grup, c.calif, a.matricula_al, a.nombre_al, a.apaterno_al, a.amaterno_al, p.nombre_prof, p.apellidop_prof, p.apellidom_prof, m.descripcion_mat, g.descripcion_grup')
            ->from('calificaciones c')
            ->join('alumnos a', 'a.id_alumn = c.id_alumn')
            ->join('profesores p', 'p.id_prof = c.id_prof')
            ->join('materias m', 'm.id_mat = c.id_mat')
            ->join('grupos g', 'g.id_grup = c.id_grup')
            ->order_by('a.nombre_al', 'ASC')
            ->get()
            ->result();
    }

    public function obtener_calificacion($id_alumn, $id_prof, $id_mat, $id_grup) {
        return $this->db
            ->where('id_alumn', $id_alumn)
            ->where('id_prof', $id_prof)
            ->where('id_mat', $id_mat)
            ->where('id_grup', $id_grup)
            ->get('calificaciones')
            ->row();
    }

    public function contar_calificaciones($id_alumn, $id_prof, $id_mat, $id_grup) {
        return $this->db
            ->where('id_alumn', $id_alumn)
            ->where('id_prof', $id_prof)
            ->where('id_mat', $id_mat)
            ->where('id_grup', $id_grup)
            ->count_all_results('calificaciones');
    }

    public function obtener_alumnos() {
        return $this->db
            ->where('estatus_al', 'alta')
            ->order_by('nombre_al', 'ASC')
            ->get('alumnos')
            ->result();
    }

    public function obtener_profesores() {
        return $this->db
            ->where('estatus_prof', 'alta')
            ->order_by('nombre_prof', 'ASC')
            ->get('profesores')
            ->result();
    }

    public function obtener_materias() {
        return $this->db
            ->where('estatus_mat', 'alta')
            ->order_by('descripcion_mat', 'ASC')
            ->get('materias')
            ->result();
    }

    public function obtener_grupos() {
        return $this->db
            ->where('estatus_grup', 'alta')
            ->order_by('descripcion_grup', 'ASC')
            ->get('grupos')
            ->result();
    }

    public function opciones_validas($datos) {
        $tablas = array(
            array('alumnos', 'id_alumn', 'estatus_al'),
            array('profesores', 'id_prof', 'estatus_prof'),
            array('materias', 'id_mat', 'estatus_mat'),
            array('grupos', 'id_grup', 'estatus_grup')
        );

        foreach ($tablas as $tabla) {
            $cantidad = $this->db
                ->where($tabla[1], $datos[$tabla[1]])
                ->where($tabla[2], 'alta')
                ->count_all_results($tabla[0]);

            if ($cantidad != 1) {
                return false;
            }
        }

        return true;
    }

    public function guardar($datos) {
        return $this->db->insert('calificaciones', $datos);
    }

    public function actualizar($id_alumn, $id_prof, $id_mat, $id_grup, $calif) {
        return $this->db
            ->where('id_alumn', $id_alumn)
            ->where('id_prof', $id_prof)
            ->where('id_mat', $id_mat)
            ->where('id_grup', $id_grup)
            ->update('calificaciones', array('calif' => $calif));
    }
}