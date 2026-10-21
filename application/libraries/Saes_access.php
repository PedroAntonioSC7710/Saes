<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saes_access {
    private $ci;

    public function __construct() {
        $this->ci =& get_instance();
        $this->ci->load->library('session');
    }

    public function role() {
        return (string) $this->ci->session->userdata('saes_role');
    }

    public function teacher() {
        return (int) $this->ci->session->userdata('saes_teacher');
    }

    public function require_role($roles) {
        if ($this->role() === '') {
            redirect('acceso');
            exit;
        }

        if (!in_array($this->role(), (array) $roles, true)) {
            show_error('Acceso no autorizado.', 403);
            exit;
        }
    }

    public function check($roles) {
        return in_array($this->role(), (array) $roles, true);
    }
}