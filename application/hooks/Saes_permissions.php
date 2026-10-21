<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saes_permissions {
    public function check() {
        $CI =& get_instance();
        $CI->load->library('session');

        $controller = strtolower($CI->router->class);
        $method = strtolower($CI->router->method);
        $role = (string) $CI->session->userdata('saes_role');

        if ($controller === 'acceso') {
            return;
        }

        if ($role === '') {
            redirect('acceso');
            exit;
        }

        $permissions = array(
            'inicio' => array('admin', 'profesor', 'alumno'),
            'alumnos' => array('admin', 'profesor', 'alumno'),
            'profesores' => array('admin', 'alumno'),
            'materias' => array('admin'),
            'grupos' => array('admin'),
            'procesos' => array('admin'),
            'calificaciones' => array('admin', 'profesor')
        );

        if (!isset($permissions[$controller])) {
            show_error('Acceso no autorizado.', 403);
            return;
        }

        if (!in_array($role, $permissions[$controller], true)) {
            show_error('Acceso no autorizado.', 403);
            return;
        }

        if ($controller === 'alumnos' && $method !== 'lista' && $role !== 'admin') {
            show_error('Acceso no autorizado.', 403);
            return;
        }

        if ($controller === 'profesores' && $method !== 'lista' && $role !== 'admin') {
            show_error('Acceso no autorizado.', 403);
            return;
        }

        if ($controller === 'calificaciones' && $method === 'exportar_excel' && $role !== 'admin') {
            show_error('Acceso no autorizado.', 403);
            return;
        }
    }
}