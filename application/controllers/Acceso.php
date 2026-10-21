<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceso extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->config->load('saes_accounts');
    }

    public function index() {
        if ($this->session->userdata('saes_role')) {
            redirect('inicio');
            return;
        }

        $this->load->view('acceso/login', array('error' => ''));
    }

    public function entrar() {
        if ($this->input->method() !== 'post') {
            show_error('Método no permitido.', 405);
            return;
        }

        $name = trim((string) $this->input->post('usuario'));
        $password = (string) $this->input->post('clave');
        $accounts = $this->config->item('saes_accounts');
        $account = isset($accounts[$name]) ? $accounts[$name] : null;

        if (
            !$account ||
            !isset($account['hash'], $account['role']) ||
            !password_verify($password, $account['hash']) ||
            !in_array($account['role'], array('admin', 'profesor', 'alumno'), true)
        ) {
            $this->load->view('acceso/login', array(
                'error' => 'Usuario o contraseña incorrectos.'
            ));
            return;
        }

        $this->session->sess_regenerate(TRUE);

        $this->session->set_userdata(array(
            'saes_role' => $account['role'],
            'saes_teacher' => isset($account['id_prof']) ? (int) $account['id_prof'] : 0,
            'saes_name' => $name
        ));

        redirect('inicio');
    }

    public function salir() {
        $this->session->sess_destroy();
        redirect('acceso');
    }
}